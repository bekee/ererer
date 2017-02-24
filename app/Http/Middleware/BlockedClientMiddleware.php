<?php

namespace App\Http\Middleware;

use Closure;

class BlockedClientMiddleware
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
	    if (auth()->user()->blocked) {
		    flash("Your have been blocked", 'danger');
		    return redirect()->guest('blocked');
	    }
        return $next($request);
    }
}
