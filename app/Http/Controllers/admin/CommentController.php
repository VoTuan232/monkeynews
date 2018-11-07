<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Comment;
use Illuminate\Support\Collection;
use App\Models\Post;
use App\Repositories\RepositoryInterface;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    private $save;
    private $res;
    private $paginate;

    public function __construct(RepositoryInterface $res) {
        $this->save = new Collection();
        $this->res = $res;
    }
    public function getComments() {

     return DB::table('posts')
        ->leftJoin('comments', 'posts.id', '=', 'comments.commentable_id' )
        ->where('posts.published', '=', true)
        ->selectRaw('posts.id as post_id, posts.slug as slug, comments.*, count(comments.id) as comment_number')->groupBy('post_id')->get();
    } 

    public function index()
    {
        $posts = $this->getComments();
        $numberPage = (int)($posts->count() / 4);
        $posts = $this->res->paginateComments($posts);

        return view('admin.comments.index', compact('posts', 'numberPage'));
    }

    public function getAllCommentDestroy($idComment) {

        $comment = Comment::find($idComment);
        $this->save = $this->save->push($comment);

        if ($comment->replies()->count() > 0 )
        {
            foreach($comment->replies as $sub_comment) {
                $this->getAllCommentDestroy($sub_comment->id);
            }
        }
        return $this->save;
    }

    public function destroyComment(Request $request) {
        $comments = $this->getAllCommentDestroy($request->id);

        foreach($comments as $comment) {
            DB::table('comments')->where('id', '=', $comment->id)->delete();
        }


        $response = array(
            'message'   => 'Đã xóa bình luận thành công',
            'class_name'  => 'alert-success'
        );
        return response()->json($response); 
    }
}
