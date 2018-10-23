<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Post;

class Category extends Model
{
    protected $fillable = [
        'name', 
        'parent_id',
    ];
    // public function posts()
    //     {
    //         if ( $this->childrens()->count() == 0 )
    //         {
    //             // dd('hihaaa');
    //             return $this->hasMany('App\Models\Category', 'parent_id');
    //         }
    //         else
    //         {
    //            return $this->hasManyThrough('App\Models\Post', 'App\childrens');
    //         }
    //     }

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post')->withTimestamps();
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }

    

    public function childrens()
    {
        return $this->hasMany('App\Models\Category', 'parent_id');
    }

    public function scopeGetCategoryNoChildren($query)
    {
        return $query->whereNull('parent_id');
    }
    
    
}
