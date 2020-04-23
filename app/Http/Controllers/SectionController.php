<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use Carbon\Carbon;
use App\Helpers\SectionHelper as SH;
use App\Helpers\SpreadSheets\SectionsImporter as SI;

class SectionController extends Controller
{
    public function index()
    {
        $now = new Carbon;
        $semester = request()->semester == null ? ($now->month <= 4 ? 'Spring ' : ($now->month <= 8 ? 'Summer ' : 'Fall ')) . $now->year : request()->semester;
        $sections = (new SH)->getViewableData(null, $semester);

        return view('section.index', compact('sections'));
    }

    public function store(Request $request)
    {
        Excel::import(new SI, $request->file('instructor_data'));

        return back()->with('success', 'Instructors appointed to sections');
    }
}
