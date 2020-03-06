<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Quiz;
use App\QuizQuestions as QQ;

class QuizController extends Controller
{
    public function create()
    {
        return view('quiz.create');
    }

    public function store(Request $request)
    {
        $quiz = Quiz::create([
                'section' => $request->section,
                'start' => Carbon::parse($request->date . ' ' . $request->start)->toDateTimeString(),
                'end' => Carbon::parse($request->date . ' ' . $request->end)->toDateTimeString(),
                'data' => $request->qData,
            ]);


        return back()->with('success', 'Quiz Successfully Created');
    }

    public function index()
    {
        return view('quiz.index');
    }

    public function start()
    {
        $navBool = null;
        
        return view('quiz.start', compact('navBool'));
    }
}
