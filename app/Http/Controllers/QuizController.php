<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Quiz;
use App\QuizQuestions as QQ;
use App\Helpers\QueryChecker as QCH;
use App\Helpers\QuizHelper as QH;
use App\QueryPool as QP;

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
        $data = $helper->generate();

        foreach ($data['temp'] as $collect) {
            array_push($data['tables'], $collect['tables']);
            array_push($data['names'], $collect['names']);
        }
        
        return view('quiz.start', compact('navBool', 'data', 'authcode'));
    }

    public function verifyQuery(Request $request)
    {
        $query = QP::find($request->question);
        $data = (new QCH)->verifyQuery($request, ['result' => false, 'error' => null, 'output' => null], $query);

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}
