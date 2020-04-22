<?php

namespace App\Helpers\SpreadSheets;

use App\Helpers\Helper;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\User;
use App\Student;
use App\Role;

class SectionsImporter extends Helper implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) {
            if ($key != 0) {
                $user = User::where('email', $row[2])->first();

                if (is_null($user)) {
                    $user = User::create(['name' => $row[1], 'email' => $row[2], 'password' => User::generatePassword()]);
                    $user->roles()->attach(Role::where('name', 'lab-instructor')->first()->id);
                }
            }
        }
    }
}