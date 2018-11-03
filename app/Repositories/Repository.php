<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;
use App\Models\Post;

class Repository implements RepositoryInterface

{
	public function paginate($items, $perPage = 4, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function getCommentBasePost(Post $post) {

    	return DB::table('posts')
	        ->leftJoin('comments', 'posts.id', '=', 'comments.commentable_id' )
	        ->selectRaw('posts.id as post_id, posts.slug as slug, comments.*, count(comments.id) as comment_number')
	        ->where('posts.id', '=', $post->id)
	        ->groupBy('post_id')->first();
    } 
}