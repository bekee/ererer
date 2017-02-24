<?php

namespace App\Http\Middleware;

use Closure;

class MyBankMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (empty(auth()->user()->ClientBank)) {
			flash("You have not added a bank detail", 'danger');
			return redirect()->guest('dashboard/add_bank');
		}
		return $next($request);
	}
}
