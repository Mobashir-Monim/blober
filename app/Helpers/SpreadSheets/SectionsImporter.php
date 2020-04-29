<?php

namespace App\Helpers\SpreadSheets;

use App\Helpers\Helper;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\User;
use App\Section;
use App\Role;
use Carbon\Carbon;
use App\Jobs\UserInviter as Inviter;

class SectionsImporter extends Helper implements ToCollection
{
    public function collection(Collection $rows)
    {
        $now = new Carbon;
        $semester = ($now->month <= 4 ? 'Spring ' : ($now->month <= 8 ? 'Summer ' : 'Fall ')) . $now->year;
        $delay = 30;

        foreach ($rows as $key => $row) {
            if ($key != 0 && $row[0] != null && $row[1] != null && $row[2] != null) {
                $user = User::where('email', $row[2])->first();

                if (is_null($user)) {
                    $password = User::generatePassword();
                    $user = User::create(['name' => $row[0], 'email' => $row[1], 'password' => $password]);
                    $user->roles()->attach(Role::where('name', 'lab-instructor')->first()->id);
                    $invite = (new Inviter($user, $password))->delay(Carbon::now()->addSeconds($delay));
                    dispatch($invite);
                    $delay += 10;
                }

                $this->addToSections($user, $row, $semester);
            }
        }
    }

    public function addToSections($user, $row, $semester)
    {
        foreach (explode(',', $row[2]) as $section) {
            $section = trim($section);

            if (is_null(Section::where('section_id', $section)->where('user_id', $user->id)->first())) {
                Section::create(['section' => $section, 'semester' => $semester]);
            }
        }
    }
}