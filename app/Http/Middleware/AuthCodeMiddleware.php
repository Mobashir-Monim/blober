<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\AuthCodeHelper as ACH;

class AuthCodeMiddleware
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
        if (!is_null(auth()->user())) {
            (new ACH(auth()->user()))->generateAuth();
        }

        return $next($request);
    }
}
