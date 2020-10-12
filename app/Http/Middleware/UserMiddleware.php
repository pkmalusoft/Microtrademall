<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UserMiddleware
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
        } else if(Auth::user()->role == 4){
            return $next($request);
        } else{
            dd('s');
            abort(401, 'Something went wrong');
            dd('You are not authorized to view this page!');
            return null;
        }
    }
}
