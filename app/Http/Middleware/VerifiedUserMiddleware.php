<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class VerifiedUserMiddleware
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
       if (!Auth::check()) {
            return redirect()->route('login');
        } else if(Auth::user()->role != 5 && Auth::user()->role != 1 
        			&& Auth::user()->verification != "0" ){
            return $next($request);
        } else{
            dd('You are not authorized to view this page!');
            abort(401, 'Something went wrong');
            return null;
        }
    }
}
