<?php

namespace App\Http\Middleware;

use Closure;

class ValidQuizLinkMiddleware
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
        if (is_null($request->sessioncode)) {
            return redirect(route('home'))->with('error', 'INVALID SESSION CODE');
        }

        return $next($request);
    }
}
