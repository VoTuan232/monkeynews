<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
	protected $fillable = [
        'post_id',
        'user_id',
        'like',
        'save',
    ];

    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id');
    }
}
