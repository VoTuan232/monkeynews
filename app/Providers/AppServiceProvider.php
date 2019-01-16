<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Config;
use Auth;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\EloquentTodo;
use App\Repositories\TodoInterface;

use App\Repositories\Repository;
use App\Repositories\RepositoryInterface;
use Illuminate\Http\Resources\Json\Resource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        if(env('REDIRECT_HTTPS')) {
            $url->forceSchema('https');
        }

        \Debugbar::disable();
        View::composer(
            '*', 'App\Http\ViewComposers\HomeComposer'
        );

        Resource::withoutWrapping(); //remove data object of resource api
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if(env('REDIRECT_HTTPS')) {
            $this->app['request']->server->set('HTTPS', true);
        }
        // $this->app->singleton(TodoInterface::class, EloquentTodo::class);
        // $this->app->singleton(RepositoryInterface::class, Repository::class);
        // $this->app->singleton(Repository::class);
        // if (!Collection::hasMacro('paginate')) {
        //     Collection::macro('paginate', 
        //         function ($perPage = 4, $page = null, $options = []) {
        //         $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        //         return (new LengthAwarePaginator(
        //             $this->forPage($page, $perPage), $this->count(), $perPage, $page, $options))
        //             ->withPath('');
        //     });
        // }
        // if ($this->app->environment('local', 'testing')) {
        //     $this->app->register(DuskServiceProvider::class);
        // }
    }
}
