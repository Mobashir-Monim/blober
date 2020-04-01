<?php

namespace App\Http\Middleware;

use Closure;
use App\Quiz;
use Carbon\Carbon;

class QuizSetValidityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $now = Carbon::now();
        $quiz = Quiz::where('section', auth()->user()->student->section)->where('start', '<=', $now)->where('end', '>', $now)->first();
        $set = $quiz->sets->where('user_id', auth()->user()->id)->first();
        
        if (!is_null($set)) {
            if (!is_null($set->endtime) || $quiz->remainingTime() <= 0) {
                $set->flag();

                return redirect(route('quiz.invalid'));
            }
        }

        return $next($request);
    }
}
