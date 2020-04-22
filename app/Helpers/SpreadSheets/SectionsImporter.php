<?php

namespace App\Helpers\SpreadSheets;

use App\Helpers\Helper;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\User;
use App\Section;
use App\Role;

class SectionsImporter extends Helper implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) {
            if ($key != 0 && $row[0] != null && $row[1] != null && $row[2] != null) {
                $user = User::where('email', $row[2])->first();

                if (is_null($user)) {
                    $user = User::create(['name' => $row[0], 'email' => $row[1], 'password' => User::generatePassword()]);
                    $user->roles()->attach(Role::where('name', 'lab-instructor')->first()->id);
                }

                $this->addToSections($user, $row);
            }
        }
    }

    public function addToSections($user, $row)
    {
        foreach (explode(',', $row[2]) as $section) {
            $section = trim($section);

            if (is_null(Section::where('section_id', $section)->where('user_id', $user->id)->first())) {
                Section::create(['section_id' => $section, 'user_id' => $user->id]);
            }
        }
    }
}