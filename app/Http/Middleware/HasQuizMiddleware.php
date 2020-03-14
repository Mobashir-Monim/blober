<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Quiz;

class HasQuizMiddleware
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
        $now = Carbon::now()->toDateTimeString();
        
        if (auth()->user()->student != null) {
            if (!is_null(Quiz::where('section', auth()->user()->student->section)->where('start', '<=', $now)->where('end', '>', $now)->first())) {
                return $next($request);
            } else {
                return back()->with('error', 'There are no valid quizzes available for you right now');
            }
        } else {
            return back()->with('error', 'Only students can attend quizzes.');
        }
    }
}
