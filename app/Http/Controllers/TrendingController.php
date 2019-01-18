<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon;
use App\Models\Post;

class TrendingController extends Controller
{
	public function __construct() {

	}

    public function getPostTrending() {
		// lay trending
    	$trending = Post::where('published', true)->WhereNotNull('trending')->orderBy('trending', 'desc')->first();
        if($trending == null) {
            $trending = Post::where('published', true)->orderBy('created_at', 'desc')->firstOrFail();
        }

       return view('pages.trending', compact('trending'));
    }
}
