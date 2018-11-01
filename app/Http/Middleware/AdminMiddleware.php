<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Session;
use Config;

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
        if ( Auth::check() && Auth::user()->roles->count() > Config::get('social.zero') && !Auth::user()->inRole('subscriber') )
        {
            return $next($request);
        }
        
        return redirect('/');
        // return $next($request);
    }
}
