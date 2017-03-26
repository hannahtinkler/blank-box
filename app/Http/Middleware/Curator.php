<?php

namespace App\Http\Middleware;

use Closure;

class Curator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!$request->user()->curator) {
            return abort(401);
        }

        return $next($request);
    }
}
