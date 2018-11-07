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

    public function accept(Request $request, $id) {
        $post = Post::find($id);
        $post->published = true;
        $post->request = 0;
        $post->save();
        DB::table('comments')->where('commentable_id',$post->id)->delete();

        return back();
    }
}
