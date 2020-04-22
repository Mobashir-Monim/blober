<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Helpers\SpreadSheets\StudentsImporter as SI;

class StudentController extends Controller
{
    public function addStudents(Request $request)
    {
        Excel::import(new SI, $request->file('student_data'));

        return back()->with('success', 'Students Added');
    }
}
