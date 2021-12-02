<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfUserAdmin
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
        /* if(!Auth::user()->is_admin) {
            return redirect('/home');
        } */
        //return $next($request);
        if(Auth::user()->userType->code == 'system_admin')
        {
            return $next($request);
        }
        return abort(403, 'Only system admin can access this.');
    }
}
