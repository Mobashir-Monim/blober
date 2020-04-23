<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\AuthorizationHelper as AH;

class AuthorizationMiddlware
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
        $helper = new AH;

        if ($helper->isAuthorized()) {
            return $next($request);
        }

        return redirect(route('home'))->with('error', 'You are not authorized');
    }
}
