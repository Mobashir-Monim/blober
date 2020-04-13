<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\SectionHelper as SH;

class SectionController extends Controller
{
    public function index()
    {
        $sections = (new SH)->getViewableData(null);

        return view('section.index', compact('sections'));
    }
}
