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
    	$trending = Post::orderBy('trending', 'desc')->firstOrFail();

       return view('pages.trending', compact('trending'));
    }
}
