<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 
        'parent_id',
    ];

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
