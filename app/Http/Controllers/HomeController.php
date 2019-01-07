<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use DB;
use Auth;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Config; 
use Event;
use Session;
// use Illuminate\Support\ServiceProvider;
use App\Repositories\TodoInterface;

use App\Repositories\RepositoryInterface;
// use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

use App\Repositories\ResAlt;
use App;

class HomeController extends Controller
{
    public  $save;
    private $res;
    private $paginate;
    private $catsHome;
    private $tags;

    protected $model;

    public function __construct(RepositoryInterface $res, Category $cat)
    {
        $this->middleware('checkviewpost');
        $this->save = new Collection();
        $this->res = $res;
        $this->catsHome = $this->res->getCategoryForHome();
        $this->tags = $this->res->getAllTag();

        $this->model = new ResAlt($cat);
    }

    public function getSearch(Request $request) {
        $posts = Post::where('body', 'LIKE', '%'.$request->text.'%')->where('published', '=', true)->orderBy('created_at', 'desc')->paginate(4);
        $posts->appends($request->only('text'));
        $textSearch = $request->text;
        $catsHome = $this->catsHome;
        $tags = $this->tags;

        // if(session()->has('lang')) {
        //     $language = session('lang');
        // }
        // else {
        //     $language = App::getLocale();
        // }
         // lay trending
        $trending = Post::orderBy('trending', 'desc')->firstOrFail();

        return view('pages.search', compact('posts', 'textSearch', 'catsHome', 'tags', 'trending'));
    }

    public function index()
    {
        // dd(session('lang'));
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

        $new = Post::where('published', '=', true)->orderBy('created_at', 'desc')->firstOrFail();
        $newList = Post::where('published', '=', true)->orderBy('created_at', 'desc')->skip(1)->take(4)->get();
        $newsHot = Post::where('published', '=', true)->orderBy('view', 'desc')->take(4)->get();
        $tags = DB::table('tags')->selectRaw('id, name')->get(); 
        $catsHome = $this->catsHome;

        // lay trending
        $trending = Post::orderBy('trending', 'desc')->firstOrFail();

        return view('pages.home', compact('categories', 'data', 'data1', 'new', 'newList', 'newsHot', 'tags', 'catsHome', 'trending'));
    }

    // public function paginate($items, $perPage = 4, $page = null, $options = [])
    // {
    //     $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
    //     $items = $items instanceof Collection ? $items : Collection::make($items);
    //     return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    // }

    public function getPosts($id, $slug) {
            $category = Category::find($id);
            $this->save = new Collection();
            $posts = $this->getAllPostsBaseCategory($id)->sortByDesc('created_at');
            $this->save = new Collection();
            $numberPage = (int)($posts->count() / 4);
            $posts = $this->res->paginate($posts);
                $this->save = new Collection();
            $postsMostPopular = $this->getAllPostsBaseCategory($id)->sortByDesc('view')->take(4);
            $this->save = new Collection();
            
            $data = [];
            $data1 = [];
            $categories = Category::where('parent_id', '=', null)->paginate(4);
            foreach ($categories as $key => $value) {
                $this->save = new Collection();
                $postsBaseCategory = $this->getAllPostsBaseCategory($value->id)->sortByDesc('created_at');
                $this->save = new Collection();
                if($postsBaseCategory->count() > 0 ) {
                    $data[$value->id] = $postsBaseCategory;
                }
              
                $data1[$value->id] = $postsBaseCategory->first();
            }

            $tags = DB::table('tags')->selectRaw('id, name')->get();
            $catsHome = $this->catsHome;  

            // lay trending
            $trending = Post::orderBy('trending', 'desc')->firstOrFail();

            return view('pages.posts_base_category', compact('posts', 'category', 'postsMostPopular', 'numberPage', 'data', 'data1', 'categories', 'tags', 'catsHome', 'trending'));
            // return view('pages.posts_base_category')->withPosts($posts)->withCategory($category)->withPostsMostPopular($postsMostPopular)->withNumberPage($numberPage)->withData($data)->withData1($data1)->withCategories($categories)->withTags($tags)->withCatsHome($this->catsHome);
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

            if ($category->childrens()->count() > 0 )
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
        $post = Post::where('slug', '=', $slug)->firstOrFail();

        if($post->published == true) {
            
                Event::fire('posts.view', $post);

                if(Auth::user()) {
                    $postAll = DB::table('posts')
                    ->leftJoin('storages', 'storages.post_id', '=', 'posts.id')
                    ->where('posts.slug', '=', $slug)
                    ->where('storages.user_id', '=', Auth::user()->id)
                    ->selectRaw('storages.*')
                    ->first();
                } 
                else {
                    $postAll = null;
                }

                $category = DB::table('category_post')
                        ->join('posts', 'category_post.post_id', '=', 'posts.id' )
                        ->join('categories', 'category_post.category_id', '=', 'categories.id' )
                        ->where('posts.id', '=', $post->id)
                        ->first();
                $category = Category::find($category->id);

                $this->save = new Collection();
                $postsRelated = $this->getAllPostsBaseCategory($category->id)->sortByDesc('created_at')->take(4);
                $this->save = new Collection();
                $tagsPost = DB::table('post_tag')
                    ->leftJoin('tags', 'tags.id', '=', 'post_tag.tag_id')
                    ->leftjoin('posts', 'posts.id', '=', 'post_tag.post_id')  
                    ->where('posts.id', '=', $post->id)
                    ->selectRaw('tags.*')->get();
                $comments = $this->res->getCommentBasePost($post);
                $data = [];
                $data1 = [];
                $categories = Category::where('parent_id', '=', null)->paginate(4);
                foreach ($categories as $key => $value) {
                    $this->save = new Collection();
                    $posts = $this->getAllPostsBaseCategory($value->id)->sortByDesc('created_at');
                    $this->save = new Collection();
                    if($posts->count() > 0 ) {
                        $data[$value->id] = $posts;
                    }
                  
                    $data1[$value->id] = $posts->first();
                }
                $tags = DB::table('tags')->selectRaw('id, name')->get();  
                $catsHome = $this->catsHome;


                // lay trending
            $trending = Post::orderBy('trending', 'desc')->firstOrFail();

                return view('pages.single', compact('post', 'category', 'postsRelated', 'postAll', 'data', 'data1', 'categories', 'tags', 'comments', 'catsHome', 'tagsPost', 'trending'));

                // return view('pages.single')->withPost($post)->withCategory($category1)->withPostsRelated($postsRelated)->withPost($post)->withPostAll($postAll)->withData($data)->withData1($data1)->withCategories($categories)->withTags($tags)->withComments($comments)->withTags($tags)->withCatsHome($this->catsHome);
        }
        return view('errors.404');

    }
    
    public function getPostsBaseTag(Request $request, $id) {
        $tag = Tag::find($id);
        $posts = DB::table('post_tag')
                ->join('posts', 'post_tag.post_id', '=', 'posts.id' )
                ->join('tags', 'post_tag.tag_id', '=', 'tags.id' )
                ->where('tags.id', '=', $id)
                ->where('posts.published', '=', true)
                ->get();

        $numberPage = (int)($posts->count() / 4);
        $posts = $this->res->paginate($posts);

        $tags = DB::table('tags')->selectRaw('id, name')->get();

        $data = [];
        $data1 = [];
        $categories = Category::where('parent_id', null)->paginate(4);
        $i =0;
        foreach ($categories as $key => $value) {
            $this->save = new Collection();
            $postsBaseCategory = $this->getAllPostsBaseCategory($value->id)->sortByDesc('created_at');
            $this->save = new Collection();
            if($postsBaseCategory->count() > 0 ) {
                $data[$value->id] = $postsBaseCategory;
            }
          
            $data1[$value->id] = $posts->first();
        }  

          // lay trending
        $trending = Post::orderBy('trending', 'desc')->firstOrFail();

        return view('pages.posts_base_tag')->withPosts($posts)->withTag($tag)->withNumberPage($numberPage)->withTags($tags)->withCatsHome($this->catsHome)->withData($data)->withData1($data1)->withCategories($categories)->withTrending($trending);
    }

    public function getPostTrending() {
        $catsHome = $this->catsHome;
        $tags = DB::table('tags')->selectRaw('id, name')->get();
        // lay trending
        $trending = Post::orderBy('trending', 'desc')->firstOrFail();

        $trending_list = Post::WhereNotNull('trending')->orderBy('trending', 'desc')->with('tags', 'comments')->paginate(5);
        // dd($trending_list);

       return view('pages.trending', compact('catsHome', 'trending', 'tags', 'trending_list'));
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
