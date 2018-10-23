<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use DB;
use Auth;
use Illuminate\Support\Collection;
use PaginateHelper;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public  $save;
    
    public function __construct()
    {
        // $this->middleware('auth');
        $this->save = new Collection();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    //  public function index()
    // {
        
    //     $data = [];
    //     $data1 = [];
    //     $categories = Category::where('parent_id', null)->paginate(4);
    //     foreach ($categories as $key => $category) {
    //         $posts = DB::table('category_post')
    //         ->join('posts', 'category_post.post_id', '=', 'posts.id' )
    //         ->join('categories', 'category_post.category_id', '=', 'categories.id')
    //         ->where('categories.parent_id', '=', $category->id)
    //         ->where('posts.published', '=', true)
    //         ->orderBy('posts.created_at', 'desc')
    //         ->select('posts.*')->get();
    //         if($posts->count() > 0 ){
    //             $data[$category->id] = $posts;
    //         }
           
    //         $data1[$category->id] = $posts->first(); 
    //     }
    //     return view('pages.home')->withCategories($categories)->withData($data)->withData1($data1);
    // }
     
    public function index()
    {
        
        $data = [];
        $data1 = [];
        $categories = Category::where('parent_id', null)->paginate(4);
        $i =0;
        foreach ($categories as $key => $category) {
            $this->save = new Collection();
            $posts = $this->getAllPostsBaseCategory($category->id)->sortByDesc('created_at');
            $this->save = new Collection();
            if($posts->count() > 0 ) {
                $data[$category->id] = $posts;
            }
          
            $data1[$category->id] = $posts->first();
        }
        return view('pages.home')->withCategories($categories)->withData($data)->withData1($data1);
    }

    public function getPosts($id, $slug) {
            $category = Category::find($id);
            $this->save = new Collection();
            $posts = $this->getAllPostsBaseCategory($id)->sortByDesc('created_at');
            $this->save = new Collection();
            return view('pages.posts_base_category')->withPosts($posts)->withCategory($category);
        }


    public  function getAllPostsBaseCategory($id)
    {
        $category = Category::find($id);

        $posts = DB::table('category_post')
                    ->join('posts', 'category_post.post_id', '=', 'posts.id' )
                    ->join('categories', 'category_post.category_id', '=', 'categories.id')
                    ->where('categories.id', '=', $id)
                    ->where('posts.published', '=', true)
                    ->select('posts.*')->get();
        $this->save = $this->save->merge($posts);

            while ($category->childrens()->count() > 0 )
            {
                foreach($category->childrens as $category) {
                    $this->getAllPostsBaseCategory($category->id);
                }
            }
        return $this->save;
    }

    //  public function getPosts($id, $slug) {
    //      $category = Category::find($id);
    //      if(!is_null($category->parent_id)) {

    //          $posts = DB::table('category_post')
    //             ->join('posts', 'category_post.post_id', '=', 'posts.id' )
    //             ->join('categories', 'category_post.category_id', '=', 'categories.id')
    //             ->where('categories.id', '=', $id)
    //             ->where('posts.published', '=', true)
    //             ->orderBy('posts.created_at', 'desc')
    //             ->select('posts.*')->paginate(6);
    //      }
    //      else if (is_null($category->parent_id)) {
    //         $posts = DB::table('category_post')
    //             ->join('posts', 'category_post.post_id', '=', 'posts.id' )
    //             ->join('categories', 'category_post.category_id', '=', 'categories.id')
    //             ->where('categories.parent_id', '=', $id)
    //             ->where('posts.published', '=', true)
    //             ->orderBy('posts.created_at', 'desc')
    //             ->select('posts.*')->paginate(6);
    //      }
    //         return view('pages.posts_base_category')->withPosts($posts)->withCategory($category);
    // }

   public function getSingle(Request $request, $slug) {

        if(Auth::user()) {
            $postAll = DB::table('posts')
            ->leftJoin('storages', 'storages.post_id', '=', 'posts.id')
            ->where('posts.slug', '=', $slug)
            ->where('storages.user_id', '=', Auth::user()->id)
            ->select('posts.*', DB::raw('COUNT(storages.id) as save'))
            ->first();
        } 
        else {
            $postAll = null;
        }
        $post = Post::where('slug', '=', $slug)->firstOrFail();
        $category = DB::table('category_post')
                ->join('posts', 'category_post.post_id', '=', 'posts.id' )
                ->join('categories', 'category_post.category_id', '=', 'categories.id' )
                ->where('posts.id', '=', $post->id)
                ->first();
        $category1 = Category::find($category->id);
        $postsRelated = $category1->posts()->latest('created_at')->where([
            ['published', '=', true],
            ['post_id', '!=', $post->id],
        ])->get();

        return view('pages.single')->withPost($post)->withCategory($category1)->withPostsRelated($postsRelated)->withPost($post)->withPostAll($postAll);
    }
    
    public function getPostsBaseTag(Request $request, $id) {
        $tag = Tag::find($id);
        $posts = DB::table('post_tag')
                ->join('posts', 'post_tag.post_id', '=', 'posts.id' )
                ->join('tags', 'post_tag.tag_id', '=', 'tags.id' )
                ->where('tags.id', '=', $id)
                ->where('posts.published', '=', true)
                ->get();
        
        return view('pages.posts_base_tag')->withPosts($posts)->withTag($tag);

    }
    // public function getSingle(Request $request, $category, $slug) {
    //     if(Auth::user()) {
    //         $postAll = DB::table('posts')
    //         ->leftJoin('storages', 'storages.post_id', '=', 'posts.id')
    //         ->where('posts.slug', '=', $slug)
    //         ->where('storages.user_id', '=', Auth::user()->id)
    //         ->select('posts.*', DB::raw('COUNT(storages.id) as save'))
    //         ->first();
    //     } 
    //     else {
    //         $postAll = null;
    //     }
    //     $post = Post::where('slug', '=', $slug)->firstOrFail();
        
    //     $category = DB::table('category_post')
    //             ->join('posts', 'category_post.post_id', '=', 'posts.id' )
    //             ->join('categories', 'category_post.category_id', '=', 'categories.id' )
    //             ->where('posts.id', '=', $post->id)
    //             ->first();
    //     $category1 = Category::find($category->id);
    //     $postsRelated = $category1->posts()->latest('created_at')->where([
    //         ['published', '=', true],
    //         ['post_id', '!=', $post->id],
    //     ])->get();

    //     return view('pages.single')->withPost($post)->withCategory($category1)->withPostsRelated($postsRelated)->withPost($post)->withPostAll($postAll);
    // }

   
}
