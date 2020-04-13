<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Quiz;
use App\QuizQuestions as QQ;
use App\Helpers\QueryChecker as QCH;
use App\Helpers\QuizHelper as QH;
use App\QueryPool as QP;
use App\Section;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = array();

        foreach (Quiz::orderBy('created_at', 'DESC')->get() as $quiz) {
            array_push($quizzes, $quiz->viewableData());
        }

        return view('quiz.index', compact('quizzes'));
    }

    public function create()
    {
        $sections = Section::where('user_id', auth()->user()->id)->select('section_id')->groupBy('section_id')->get()->pluck('section_id')->toArray();

        if (auth()->user()->highestRole()->name == 'developer' || auth()->user()->highestRole()->name == 'lab-coordinator') {
            $sections = Section::select('section_id')->groupBy('section_id')->get()->pluck('section_id')->toArray();
        }

        return view('quiz.create', compact('sections'));
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

    public function show(Request $request, Quiz $quiz)
    {
        $data = $quiz->viewableData();
        $data['details'] = json_decode($quiz->data, true);
        $data['edit'] = !is_null(User::getUser($request->sessioncode));
        $data['delete'] = is_null(User::getUser($request->sessioncode)) ? false : $quiz->creator->id == User::getUser($request->sessioncode)->id;

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function edit(Request $request, Quiz $quiz)
    {
        $sections = Section::where('user_id', auth()->user()->id)->select('section_id')->groupBy('section_id')->get()->pluck('section_id')->toArray();

        if (auth()->user()->highestRole()->name == 'developer' || auth()->user()->highestRole()->name == 'lab-coordinator') {
            $sections = Section::select('section_id')->groupBy('section_id')->get()->pluck('section_id')->toArray();
        }

        return view('quiz.edit', compact('quiz', 'sections'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $quiz->updateQuiz($request);

        return redirect(route('quiz.index'))->with('success', 'Quiz Updated');
    }

    public function deleteQuiz(Request $request, Quiz $quiz)
    {
        $flag = User::getUser($request->sessioncode)->id == $quiz->creator->id;

        if ($flag) {
            $quiz->delete();
        }

        return response()->json([
            'success' => $flag,
            'message' => $flag ? 'Quiz successfully deleted' : 'You are not authorized to delete this quiz',
        ]);
    }

    public function panel()
    {
        $now = Carbon::now();
        $time = Quiz::where('section', auth()->user()->student->section)->where('start', '<=', $now)->where('end', '>', $now)->first()->remainingTime();

        return view('quiz.panel', compact('time'));
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

    public function invalid()
    {
        $navBool = false;
        $message = !is_null(request()->is_voluntary);
        $now = Carbon::now();
        $quiz = Quiz::where('section', auth()->user()->student->section)->where('start', '<=', $now)->where('end', '>', $now)->first();
        $set = $quiz->sets->where('user_id', auth()->user()->id)->first();
        $set->flag();

        return view('quiz.invalid', compact('navBool', 'message'));
    }
}
