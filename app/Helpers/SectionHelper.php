<?php

namespace App\Helpers;

use App\Section;
use App\Student;
use App\User;

class SectionHelper extends Helper
{
    public function getViewableData($section, $semester)
    {
        if (isset($section) || !is_null($section)) {
            return $this->getSectionData($section);
        } else {
            return $this->allSections($semester);
        }
    }

    public function getSectionData($section)
    {
        $data = ['section' => $section, 'instructors' => array(), 'students' => $this->getStudentData($section)];

        foreach (Section::find($section)->users as $entity) {
            array_push($data['instructors'], $entity->name);
        }

        return $data;
    }

    public function allSections($semester)
    {
        $data = array();

        foreach (Section::where('semester', $semester)->get() as $key => $section) {
            $sdata = ['section' => $section->section, 'instructors' => array(), 'students' => $this->getStudentData($section->id)];

            foreach ($section->users as $entity) {
                array_push($sdata['instructors'], $entity->name);
            }

            array_push($data, $sdata);
        }

        return $data;
    }

    public function getStudentData($section)
    {
        $students = array();

        foreach (Student::where('section', $section)->get() as $student) {
            array_push($students, [
                'name' => $student->user->name,
                'sid' => $student->student_id,
                'dashboard' => route('home.user', ['email' => $student->user->email]),
                'points' => $student->points,
            ]);
        }
        
        return $students;
    }

    public function createSection($section, $semester)
    {
        return Section::create(['section' => $section, 'semester' => $semester]);
    }
}