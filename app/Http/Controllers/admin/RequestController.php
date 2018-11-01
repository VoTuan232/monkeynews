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
         ->where('posts.request', '=', 1)
         ->orderBy('posts.requested_at','asc')
        ->selectRaw('posts.id, posts.title, posts.slug, posts.body, posts.image, posts.published, posts.like, posts.dislike, posts.view, users.name as username, posts.user_id')->orderBy('posts.id', 'asc')->get(); 

    }

    public function index()
    {
        $posts = $this->getRequests();
        return view('admin.publish.index')->withPosts($posts);
    }

    public function closeRequest(Request $request, $id) {
        $post = Post::find($id);
        $post->request = 2;
        $post->save();

        return back();
    }

    //xoa comment cu 
    public function accept(Request $request, $id) {
        $post = Post::find($id);
        $post->published = true;
        $post->request = 0;
        $post->save();

        DB::table('comments')->where('commentable_id',$post->id)->delete();

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
