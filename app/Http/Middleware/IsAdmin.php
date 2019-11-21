<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        if ($request->loggedin_email != 'admin@ub.ac.id') {
            return abort(403, 'Forbidden');
        }
        return $next($request);
    }
}
