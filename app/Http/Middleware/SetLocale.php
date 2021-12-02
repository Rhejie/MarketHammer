<?php

namespace App\Http\Middleware;

use Closure;

class SetLocale
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
        if($request->hasHeader('X-localization')){
            $locale = $request->header('X-localization');
            \App::setLocale($locale);
        }
        else{
           isset(auth()->user()->language) && auth()->user()->language ? \App::setLocale(auth()->user()->language) : null; 
        }
        

        return $next($request);
    }
}
