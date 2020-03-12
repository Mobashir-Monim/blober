<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Quiz;
use App\QuizQuestions as QQ;
use App\Helpers\QuizHelper as QH;

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
        dd(auth()->user()->id);

        $navBool = false;
        $helper = new QH;
        $qids = $helper->getQids();
        $questions = $helper->makeQuestions();
        $temp = $helper->getTables();
        $tables = array();
        $names = array();

        foreach ($temp as $collect) {
            array_push($tables, $collect['tables']);
            array_push($names, $collect['names']);
        }
        
        return view('quiz.start', compact('navBool', 'tables', 'questions', 'qids', 'names'));
    }
}
