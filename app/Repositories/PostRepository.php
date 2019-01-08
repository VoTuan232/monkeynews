<?php

namespace App\Repositories;

use App\Models\Post;
use DB;

class PostRepository extends EloquentRepository
{
    public function model()
    {
        return Post::class;
    }

    public function getCommentBasePost(Post $post) {

    	return DB::table('posts')
	        ->leftJoin('comments', 'posts.id', '=', 'comments.commentable_id' )
	        ->selectRaw('posts.id as post_id, posts.slug as slug, comments.*, count(comments.id) as comment_number')
	        ->where('posts.id', '=', $post->id)
	        ->groupBy('post_id')->first();
    } 
}
