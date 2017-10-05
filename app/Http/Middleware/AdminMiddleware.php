<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminMiddleware
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
       if (Auth::user() && Auth::check()) {
            if (Auth::user()->email === "locnetarganda@gmail.com") {
                return $next($request);
            } else {
                return view('errors/admin503');
            }
        }
        return redirect('/admin');
    }
}