<?php

namespace App\Helpers\SpreadSheets;

use App\Helpers\Helper;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\QuizAttempt as QA;
use App\QuizAttemptGroup as QAG;
use App\Quiz;
use App\Student;

class QuizScoreExporter extends Helper implements FromView
{
    public function view(): View
    {
        $quiz = Quiz::find(explode('/',request()->path())[2]);
        $scores = $this->generateScores(Student::where('section', $quiz->section)->get(), $quiz);

        return view('exportable.quiz-score', compact('scores'));
    }

    public function generateScores($students, $quiz)
    {
        $scores = array();

        foreach ($students as $student) {
            $user = $student->user;
            $set = $this->findTimeFrame($user, $quiz);
            $score = $this->calculateScore($user, $quiz);

            $scores[$student->student_id] = [
                'name' => $user->name,
                'start' => $set[0]->start,
                'end' => $set[0]->endtime,
                'attempted' => $score['attempted'],
                'score' => $score['points'],
            ];
        }

        return $scores;
    }

    public function findTimeFrame($user, $quiz)
    {
        $set = \DB::select("select start, endtime from quiz_sets where user_id = $user->id and quiz_id = $quiz->id;");

        if (sizeof($set) == 0) {
            $set[0] = new \stdClass();
            $set[0]->start = 'DID NOT ATTEND';
            $set[0]->endtime = 'DID NOT ATTEND';
        }

        return $set;
    }

    public function calculateScore($user, $quiz)
    {
        $score = ['points' => 0, 'attempted' => 0];
        $groups = \DB::select("select query_pool_id from quiz_attempts where user_id = $user->id and quiz_id = $quiz->id group by query_pool_id;");

        if (sizeof($groups) != 0) {
            $score['attempted'] = sizeof($groups);

            foreach (QA::where('user_id', $user->id)->where('quiz_id', $quiz->id)->get() as $attempt) {
                if ($attempt->is_correct) {
                    $score['points'] += $attempt->question->points;
                } else {
                    $score['points'] -= $attempt->question->deductible != null ? $attempt->question->deductible : 0;
                }
            }
        }

        return $score;
    }
}