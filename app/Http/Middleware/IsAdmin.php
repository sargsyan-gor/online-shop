<?php

namespace App\Http\Middleware;

use Closure;
class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        abort_unless($request->user()->isAdmin(), 403, 'Sorry, you are unauthorized to view this page.');

        return $next($request);
    }
}
