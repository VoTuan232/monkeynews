<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Post;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRequests() {
         return  Post::join('users', 'users.id', '=', 'posts.user_id')
         ->where('posts.published', '=', false)
         ->where('posts.request', '=', true)
         ->orderBy('posts.requested_at','asc')
        ->selectRaw('posts.id, posts.title, posts.slug, posts.body, posts.image, posts.published, posts.vote, posts.view, users.name as username, posts.user_id')->orderBy('posts.id', 'asc')->get(); 

    }

    public function index()
    {
        $posts = $this->getRequests();
        return view('admin.publish.index')->withPosts($posts);
    }

    public function closeRequest(Request $request, $id) {
        $post = Post::find($id);
        $post->request = null;
        $post->save();

        return back();
    }

    public function accept(Request $request, $id) {
        $post = Post::find($id);
        $post->published = true;
        $post->save();
        return back();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
