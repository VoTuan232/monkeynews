<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Config;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //truyen toi tat ca cac view ( * )
        View::composer(
            '*', 'App\Http\ViewComposers\HomeComposer'
        );
        // $cats = Category::where('parent_id', null)->take(4)->get();
        // View::share(*, $data);
        
        //check auth tai view blade: sau khi change chay lenh: php artisan view:clear
        /*Blade::directive('admin', function () {
            $isAdmin = false;

             if ( Auth::check() && Auth::user()->roles->count() > 0) 
            {

                $isAdmin = true;
            }

            return "<?php if ($isAdmin) { ?>";
        });

        Blade::directive('endadmin', function () {
            return "<?php } ?>";
        });
        */
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
