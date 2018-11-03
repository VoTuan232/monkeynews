<?php
namespace App\Http\Middleware;
use Closure;
use Session;
use Config;
use App;

class Locale
{
    public function handle($request, Closure $next)
    {
    	if(Session::has('locale')) {
    		$locale = Session::get('locale', Config::get('app.locale'));
    	}
    	else {
    		// $locale = 'en';
    		$locale = Config::get('app.locale');
    	}

    	App::setlocale($locale);

    	return $next($request);
        // $language = \Session::get('website_language', config('app.locale'));
        // // Lấy dữ liệu lưu trong Session, không có thì trả về default lấy trong config

        // config(['app.locale' => $language]);
        // // Chuyển ứng dụng sang ngôn ngữ được chọn

        // return $next($request);
    }

}

