<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'body',
        'user_id',
        'image',
        'published',
        'request',
        'view',
        'trending',
    ];

    public function user()
    {
        $this->belongsTo('App\Models\User', 'user_id');
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeUnpublished($query)
    {
        return $this->where('published', false);
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category')->withTimestamps();
    }

   
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable')->whereNull('parent_id')->orderBy('created_at', 'desc');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    public static function getCategory(Post $post) {
         if($post->categories()->count() > 0 )
            {
                $id = 0;
                foreach($post->categories()->get() as $category)
                {

                    foreach($post->categories()->get() as $category1)
                    {
                        if($category1->parent_id == $category->id){
                            $id += 1;
                        }

                            
                    }

                    if($id == 0){

                        $cat = $category;
                        break;
                    }
                    else
                    {
                        $id = 0;
                    }

                }
                return $cat;
            }
        return null;
    }

}
