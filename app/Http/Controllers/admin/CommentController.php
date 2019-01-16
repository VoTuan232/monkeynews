<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Comment;
use Illuminate\Support\Collection;
use App\Models\Post;
use App\Repositories\CommentRepository;
use Yajra\DataTables\DataTables;
use App\Models\User;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    private $save;
    private $commentRepository;

    public function __construct(CommentRepository $commentRepository) {
        $this->save = new Collection();
        $this->commentRepository = $commentRepository;
    }

    // public function getComments() {
    //     return DB::table('posts')
    //     ->leftJoin('comments', 'posts.id', '=', 'comments.commentable_id' )
    //     ->where('posts.published', '=', true)
    //     ->selectRaw('posts.id as post_id, posts.slug as slug, comments.*, count(comments.id) as comment_number')->groupBy('post_id')->get();
    // } 

    public function index() {
        
        return view('admin.comments.index');
    }

    public function getComments() {
        $data = Post::Where('published', '1')->with('comments', 'user')->get();
        return DataTables::of($data)
        ->addColumn('role', function($data){
            return $data->user->roles->first()->name;
        })
        ->addColumn('total_comments', function($data){
            return $data->comments->count();
        })
        ->toJson();
    }

    // public function getComments() {
    //     return DataTables::of(User::query())
    //     // ->setRowClass(function ($user) {
    //     //     return $user->id %2 == 0 ? 'alert-success' : 'alert-warning';
    //     // }) //hang se doi mau
    //     // ->setRowClass('{{ $id %2 == 0 ? "alert-success" : "alert-warning" }}')
    //     // ->setRowClass('{{ $email == "buster.klocko@example.net" ? "alert-success" : "alert-warning" }}')
    //     ->setRowId(function ($user) {
    //         return $user->id;
    //     }) //tr se chua id cua user
    //     // ->setRowAttr([ 'align' => 'center' ])
    //     ->setRowData(['data-name' => 'row-{{$name}}, '])
    //     // ->make(true);
    //     ->addColumn('role', function (User $user) {
    //          if($user->roles->count() > 0) {
    //             return $user->roles->first()->name;
    //          }
    //          else{
    //             return "";
    //          }
    //     })
    //     // ->editColumn('created_at', function (User $user) {
    //     //     return $user->created_at->diffForHumans();
    //     // }) // time past
    //     ->editcolumn('updated_at', 'column') //tra ve view column
    //     ->rawColumns(['updated_at'])
    //     ->removeColumn('updated_at')
    //     ->make(true);
    // }

    // public function index()
    // {
    //     $posts = $this->getComments();
    //     $numberPage = (int)($posts->count() / 4);
    //     $posts = $this->commentRepository->paginate($posts);

    //     return view('admin.comments.index', compact('posts', 'numberPage'));
    // }

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
