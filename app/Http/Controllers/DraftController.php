<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\PostRequest;
use Validator;
use Image;
use File;
use Auth;
use App\Validations\Validation;
use Gate;
use Illuminate\Database\Eloquent\Model;
use Carbon;
use DB;


class DraftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct() {
        $this->middleware(['auth']);
    }
    
    public function index()
    {
        $categories = Category::all();
        $trees = Category::where('parent_id',null)->get();
        $posts = $this->getPosts();
        // dd($posts = $this->getPosts());

        return view('drafts.index')->withPosts($posts)->withCategories($categories)->withTrees($trees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getPosts()
    {
        return Post::join('users', 'users.id', '=', 'posts.user_id')
        ->leftJoin('comments', 'comments.commentable_id', '=', 'posts.id')
        ->where('posts.published', '=', false)
        ->where('users.id', '=', Auth::user()->id)
        ->selectRaw('posts.id, posts.title, posts.slug, posts.body, posts.image, posts.published, posts.like, posts.dislike, posts.view, users.name as username, posts.user_id, posts.request as request, comments.commentable_id as comment')->distinct()->orderBy('posts.id', 'asc')->get(); 

        
    }

    public function store(Request $request, $id)
    {
        // dd(Carbon\Carbon::now());
        $post =  Post::find($id);
        if(Auth::user()->id == $post->user_id) {
            $post->request = 1;
            $post->requested_at = Carbon\Carbon::now();
            $post->save();
        }

        return back();
    }

    public function close(Request $request, $id)
    {
        // dd(Carbon\Carbon::now());
        $post =  Post::find($id);
        if(Auth::user()->id == $post->user_id) {
            $post->request = 0;
            $post->requested_at = Carbon\Carbon::now();
            $post->save();
        }

        return back();
    }

    public function getSingle(Request $request, $id) {
        $post = Post::find($id);
        if($post->published == 1 || Auth::user()->id == $post->user_id || Gate::allows('post.publish')) {
            return view('drafts.view')->withPost($post);
        }

         return view('errors.404');
        // return view('errors.404',$data,404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $trees = Category::where('parent_id',null)->get();

    if($post->categories()->count() > 0 )
       {
            $cat = $post->categories()->first();
            return view('drafts.edit')->withPost($post)->withCategory($cat->name)->withTrees($trees);
        }
    else{

            return view('drafts.edit')->withPost($post)->withCategory(null)->withTrees($trees);
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
