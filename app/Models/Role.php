<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 
        'slug', 
        'permissions',
    ];

    protected $casts = [
        'permissions' => 'array',
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'role_user');
    }

    //kiem tra role co 1 chuc nang nao do trong 1 mang permission truyen vao
    //
    //can xem lai: role phai co tat ca cac permission...=> if! false else true.
    public function hasAccess(array $permissions):bool
    {
        // foreach ($permissions as $permission)
        // {
        //     if ($this->hasPermission($permission))
        //     {
        //         return true;
        //     }
        // }
        // return false;

        foreach ($permissions as $permission)
        {
            if (!$this->hasPermission($permission))
            {
                return false;
            }
        }
        return true;
    }

    //kiem tra role co 1 quyen gi do ( true or false)
    private function hasPermission(string $permission)
    {
        return $this->permissions[$permission] ?? false;
    }
}
