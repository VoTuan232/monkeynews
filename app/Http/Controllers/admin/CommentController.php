<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Comment;
use Illuminate\Support\Collection;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    private $save;

    public function __construct() {
        $this->save = new Collection();
    }
    public function getComments() {

     return DB::table('posts')
        ->leftJoin('comments', 'posts.id', '=', 'comments.commentable_id' )
        ->selectRaw('posts.id as post_id, posts.slug as slug, comments.*, count(comments.id) as comment_number')->groupBy('post_id')->get();
    } 

    public function index()
    {
        $posts = $this->getComments();
        // dd($posts);
        return view('admin.comments.index')->withPosts($posts);
    }

    public function getAllCommentDestroy($idComment) {

        // $comment = DB::table('comments')->where([
        //     'id' => $idComment,
        //     'commentable_id' => $idPost,
        // ])->get();

        // $this->save = $this->save->merge($comment);
        $comment = Comment::find($idComment);
        $this->save = $this->save->merge($comment);

        while ($comment->replies()->count() > 0 )
        {
            foreach($comment->replies as $sub_comment) {
                $this->getAllCommentDestroy($sub_comment->id);
            }
        }

        return $this->save;
    }

    public function destroyComment(Request $request) {

        // $comments = $this->getAllCommentDestroy($request->id, $request->post_id);

        $comment = DB::table('comments')->where([
            'id' => $request->id,
            'commentable_id' => $request->post_id,
        ])->first();

        // $comments = $comment->replies()->count();

        $response = array(
            'data' => $comment,
            'message'   => 'Đã xóa bình luận thành công',
            'class_name'  => 'alert-success'
        );
        return response()->json($response); 
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
