<?php

namespace App\Http\Middleware;

use Closure;


class Mine
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
        $slug = $request->segment(2);

        if ($slug != $request->user()->slug) {
            \App::abort(401);
        }
        return $next($request);
    }
}
