<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\PostPolicy;
use App\Policies\TagPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\UserPolicy;
use App\Policies\RolePolicy;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
       
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            if ($user->inRole('super-admin')) {
                return true;
            }
        });

        Gate::resource('tag', TagPolicy::class);
        Gate::resource('category', CategoryPolicy::class);
        Gate::resource('user', UserPolicy::class);
        Gate::resource('post', PostPolicy::class);
        Gate::resource('role', RolePolicy::class);
        Gate::define('post.publish', PostPolicy::class . '@publish');
      
    }
}
