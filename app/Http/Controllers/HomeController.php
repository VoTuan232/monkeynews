<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        // $cat = Category::find(1);
        // foreach ($cat->childrens as $key => $value) {
        //     dd($value->posts());
        // }

        $data = [];
        $data1 = [];
        $categories = Category::where('parent_id', null)->paginate(4);
        foreach ($categories as $key => $category) {
            $posts = DB::table('category_post')
            ->join('posts', 'category_post.post_id', '=', 'posts.id' )
            ->join('categories', 'category_post.category_id', '=', 'categories.id')
            ->where('categories.parent_id', '=', $category->id)
            ->where('posts.published', '=', true)
            ->orderBy('posts.created_at', 'desc')
            ->select('posts.*')->get();
            if($posts->count() > 0 ){

            $data[$category->id] = $posts;
            }
            // if($category->id == 2) {
            //     dd($data);
            // }
            $data1[$category->id] = $posts->first(); 
        }
        // dd($data[2]);
        return view('pages.home')->withCategories($categories)->withData($data)->withData1($data1);
    }

    // public function index()
    // {
    //     $data = [];
    //     // $categories = Category::where('parent_id', null)->take(4)->get();
    //     $categories = Category::where('parent_id', null)->paginate(4);
    //     foreach ($categories as $key => $category) {
    //         //3 bai moi nhat
    //         $data[$category->id] = $category->posts()->where('published', '=', true)->latest('created_at')->get();
    //         //1 bai moi nhat  
    //         $data1[$category->id] = $category->posts()->where('published', '=', true)->latest('created_at')->first(); 
    //     }
    //     return view('pages.home')->withCategories($categories)->withData($data)->withData1($data1);
    // }
    // 
     public function getPosts($id, $slug) {
         $category = Category::find($id);
         // dd($category->parent_id);
         if(!is_null($category->parent_id)) {

             $posts = DB::table('category_post')
                ->join('posts', 'category_post.post_id', '=', 'posts.id' )
                ->join('categories', 'category_post.category_id', '=', 'categories.id')
                ->where('categories.id', '=', $id)
                ->where('posts.published', '=', true)
                ->orderBy('posts.created_at', 'desc')
                ->select('posts.*')->paginate(6);
         }
         else if (is_null($category->parent_id)) {
            $posts = DB::table('category_post')
                ->join('posts', 'category_post.post_id', '=', 'posts.id' )
                ->join('categories', 'category_post.category_id', '=', 'categories.id')
                ->where('categories.parent_id', '=', $id)
                ->where('posts.published', '=', true)
                ->orderBy('posts.created_at', 'desc')
                ->select('posts.*')->paginate(6);
         }
            // dd($posts);
            return view('pages.posts_base_category')->withPosts($posts)->withCategory($category);
    }

    // public function getPosts($id, $slug) {
    //     // dd('hihi');
    //     $category = Category::find($id);
    //     // $posts = $category->posts()->get();
    //     // $category = Category::where('name', '=', $request->slug)->firstOrFail();
    //     $posts = $category->posts()->where('published', '=', true)->latest('created_at')->take(6)->paginate(6);
    //     //lay ds category cha
    //     // $c = Category::find(9);
    //     // dd($c->parent()->first()->name);
    //     // foreach($category as $cat) {

    //     //     $data[$cat->id][] = $cat->parent()->first();
    //     // }
    //     return view('pages.posts_base_category')->withPosts($posts)->withCategory($category);
    // }
    
    public function getSingle(Request $request, $category, $slug) {
        // $post = Post::where('slug', '=', $slug)->firstOrFail();
        if(Auth::user()) {
            $postAll = DB::table('posts')
            ->leftJoin('storages', 'storages.post_id', '=', 'posts.id')
            ->where('posts.slug', '=', $slug)
            ->where('storages.user_id', '=', Auth::user()->id)
            ->select('posts.*', DB::raw('COUNT(storages.id) as save'))
            ->first();
        } //chua trang thai bai post cua user da dang nhap
        else {
            $postAll = null;
        }
        // dd($postAll);
        $post = Post::where('slug', '=', $slug)->firstOrFail();
        
        // dd($post);
        //neu ko co post=> trang thai null
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

    //  public function getSingle(Request $request, $category, $slug) {
    //     $post = Post::where('slug', '=', $slug)->firstOrFail();
    //     $category = DB::table('category_post')
    //             ->join('posts', 'category_post.post_id', '=', 'posts.id' )
    //             ->join('categories', 'category_post.category_id', '=', 'categories.id' )
    //             ->where('posts.id', '=', $post->id)
    //             ->first();
    //     $category1 = Category::find($category->id);
    //             // dd($post);
    //     $postsRelated = $category1->posts()->latest('created_at')->where([
    //         ['published', '=', true],
    //         ['post_id', '!=', $post->id],
    //     ])->get();

    //     return view('pages.single')->withPost($post)->withCategory($category1)->withPostsRelated($postsRelated)->withPost($post);
    // }


    //category truyen co the la cha cat hoac con cat
    //nhung dau ra phai la con category
    // public function getSingle(Request $request, $category, $slug) {
    //     // dd($request->category);
    //     // 
    //     // dd($category); //khi kich post tai the thao thi category la the thao, nhung bai post do o muc bong da==> can tro toi muc bong da.
    //     $post = Post::where('slug', '=', $slug)->firstOrFail();
    //     // dd($post->slug);
    //     $category = Post::getCategory($post); //get category nho nhat
    //     //lay cac bai post cung chu de( ko lay post dang show)
    //     $postsRelated = $category->posts()->latest('created_at')->where([
    //         ['published', '=', true],
    //         ['post_id', '!=', $post->id],
    //     ])->get();

    //     // $postsRelated = $category->posts()->latest('created_at')->where('published', '=', true)->get();
    //     // dd($postsRelated);
    //     // dd($posts);
    //     // dd(Post::getCategory($post)->name);
    //     // dd(Post::getCategory($post)->name);
    //     // dd($post->categories()->first()->name); //=> ngoai hang anh neu post do thuoc ngoai hang anh
    //     return view('pages.single')->withPost($post)->withCategory($category)->withPostsRelated($postsRelated)->withPost($post);
    // }

    
    // public function readData(){
    //     dd('abc');
    //     return 'sbv';
    //     // $posts = Post::all();
    //     $posts = User::all();
    //     // // return response($posts);
    //     // return view('posts.post_info')->withPosts($posts);
   
    //     // return view('admin.posts.post_info');
    //     // return response("syyu");
    //     return response("dsfds");
    // }
}
