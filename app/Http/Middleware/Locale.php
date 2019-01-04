<?php
namespace App\Http\Middleware;

use Closure;
use Config;
use Session;
class Locale
{
    public function handle($request, Closure $next)
    {
        //after
        \App::setLocale($request->session()->get('lang'));

        //before
        // if($language = $request->session()->get('lang')){
        //     \App::setLocale($language);
        // }
        return $next($request);
    }

}

