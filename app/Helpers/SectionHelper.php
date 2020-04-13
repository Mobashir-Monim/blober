<?php

namespace App\Helpers;

use App\Section;
use App\Student;
use App\User;

class SectionHelper extends Helper
{
    public function getViewableData($section)
    {
        if (isset($section) || !is_null($section)) {
            return $this->getSectionData($section);
        } else {
            return $this->allSections();
        }
    }

    public function getSectionData($section)
    {
        $data = ['section' => $section, 'instructors' => array(), 'students' => $this->getStudentData($section)];

        foreach (Section::where('section_id', $section)->get() as $entity) {
            array_push($data['instructors'], $entity->user->name);
        }

        return $data;
    }

    public function allSections()
    {
        $data = array();
        $sections = Section::select('section_id')->groupBy('section_id')->get()->pluck('section_id')->toArray();

        foreach ($sections as $key => $section) {
            $sdata = ['section' => $section, 'instructors' => array(), 'students' => $this->getStudentData($section)];

            foreach (Section::where('section_id', $section)->get() as $entity) {
                array_push($sdata['instructors'], $entity->user->name);
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
}