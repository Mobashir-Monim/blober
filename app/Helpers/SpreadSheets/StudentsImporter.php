<?php

namespace App\Helpers\SpreadSheets;

use App\Helpers\Helper;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\User;
use App\Student;
use App\Role;

class StudentsImporter extends Helper implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) {
            if ($key != 0 && $row[0] != null && $row[1] != null && $row[2] != null && $row[3]) {
                $user = User::where('email', $row[2])->first();

                if (is_null($user)) {
                    $user = User::create(['name' => $row[1], 'email' => $row[2], 'password' => User::generatePassword()]);
                    // dd($row, ['name' => $row[1], 'email' => $row[2], 'password' => User::generatePassword()]);
                    $user->roles()->attach(Role::where('name', 'student')->first()->id);
                }

                if (is_null($user->student)) {
                    Student::create($this->generateStudentDataArray($user, $row));
                } else {
                    $user->student->incrementStatus();
                }
            }
        }
    }

    public function generateStudentDataArray($user, $row)
    {
        return [
            'user_id' => $user->id,
            'level_name' => 'Beginner',
            'level' => 0,
            'enrollment' => Student::getEnrollment(),
            'section' => $row[3],
            'status' => 'first-enrollment',
            'student_id' => $row[0]
        ];
    }
}