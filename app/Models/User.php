<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_user');
    }

    public function hasAccess(array $permission):bool
    {
        foreach ($this->roles as $role)
        {
            if ($role->hasAccess($permission))
            {
                return true;
            }
        }
        return false;
    }

    public function inRole(string $roleSlug)
    {
        return $this->roles()->where('slug', $roleSlug)->count() == 1;
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'user_id');
    }

    public function isAdmin() 
    {
       if ( $this->roles->count()>0 && !$this->inRole('subscriber') )
        {
            return true;
        }

        return false;

    }
}
