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
        $now = Carbon::now();
        $time = Quiz::where('section', auth()->user()->student->section)->where('start', '<=', $now)->where('end', '>', $now)->first()->remainingTime();

        return view('quiz.index', compact('time'));
    }

    public function start()
    {
        $authcode = request()->sessioncode;
        $navBool = false;
        $helper = new QH;
        $qids = $helper->getQids();
        $questions = $helper->makeQuestions();
        $temp = $helper->getTables();
        $tables = array();
        $names = array();
        $time = $helper->getTime();
        $groups = $helper->getGroups();

        foreach ($temp as $collect) {
            array_push($tables, $collect['tables']);
            array_push($names, $collect['names']);
        }
        
        return view('quiz.start', compact('navBool', 'tables', 'questions', 'qids', 'names', 'time', 'groups', 'authcode'));
    }
}
