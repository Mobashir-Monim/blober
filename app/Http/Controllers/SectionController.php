<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Helpers\SectionHelper as SH;
use App\Helpers\SpreadSheets\SectionsImporter as SI;

class SectionController extends Controller
{
    public function index()
    {
        $sections = (new SH)->getViewableData(null);

        return view('section.index', compact('sections'));
    }

    public function store(Request $request)
    {
        Excel::import(new SI, $request->file('instructor_data'));

        return back()->with('success', 'Instructors appointed to sections');
    }
}
