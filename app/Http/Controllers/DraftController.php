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
use App\Repositories\CategoryRepository;
use App\Repositories\TagRepository;

class DraftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $categoryRepository;
    private $tagRepository;

    public function __construct(
        CategoryRepository $categoryRepository, 
        TagRepository $tagRepository) 
    {
        $this->middleware(['auth']);
        $this->tagRepository = $tagRepository;
        $this->categoryRepository = $categoryRepository;
    }
    
    public function index()
    {
        $categories = Category::all();
        $trees = Category::where('parent_id',null)->get();
        $posts = $this->getPosts();

        $catsHome = $this->categoryRepository->getCategoryForHome();
        $tags = $this->tagRepository->getAllTag();

        // lay trending
        $trending = Post::orderBy('trending', 'desc')->firstOrFail();

        return view('drafts.index', compact('posts', 'categories', 'trees', 'tags', 'catsHome', 'trending'));
    }

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
        if($post->published == 0 && (Auth::user()->id == $post->user_id || Gate::allows('post.publish'))) {

            return view('drafts.view')->withPost($post);
        }

         return view('errors.404');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        if($post->published == 0 && (Auth::user()->id == $post->user_id || Gate::allows('post.publish'))) {
            $trees = Category::where('parent_id',null)->get();

            if($post->categories()->count() > 0 )
               {
                    $category = $post->categories()->first()->name;
                }
            else{
                    $category = null;
                }

                $tags = $this->tags;

                return view('drafts.edit', compact('post', 'category', 'trees', 'tags'));
        }

        return view('errors.404');
    }
}
