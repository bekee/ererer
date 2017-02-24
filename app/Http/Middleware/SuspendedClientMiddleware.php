<?php

namespace App\Http\Middleware;

use Closure;

class SuspendedClientMiddleware
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
	    if (auth()->user()->account=='suspended') {
		    flash("Your have been suspended contact administrator", 'danger');
		    return redirect()->guest('suspend');
	    }
        return $next($request);
    }
}
