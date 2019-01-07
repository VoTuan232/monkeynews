<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Debugbar::disable();
        View::composer(
            '*', 'App\Http\ViewComposers\HomeComposer'
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TodoInterface::class, EloquentTodo::class);
        $this->app->singleton(RepositoryInterface::class, Repository::class);
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
