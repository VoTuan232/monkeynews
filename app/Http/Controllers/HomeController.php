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

use App\Repositories\TodoInterface;

use App\Repositories\RepositoryInterface;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public  $save;
    private $res;
    // private $res;
    
    public function __construct(RepositoryInterface $res)
    {

        $this->middleware('checkviewpost');
        $this->save = new Collection();
        $this->res = $res;
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
    public function getSearch(Request $request) {
        // dd($request->all());
        // dd('hihi');
        $posts = Post::where('body', 'LIKE', '%'.$request->text.'%')->where('published', '=', true)->orderBy('created_at', 'desc')->paginate(4);
        $posts->appends($request->only('text'));
        // dd($posts);
        return view('pages.search')->withPosts($posts)->withTextSearch($request->text);
    }

    public function postSearch(Request $request) {
        // dd('hihi');
        $posts = Post::where('body', 'LIKE', '%'.$request->text.'%')->orderBy('created_at', 'desc')->paginate(4);
        // dd($posts->count());
        $numberPage = (int)($posts->count() / 4);

        return view('pages.search')->withPosts($posts)->withTextSearch($request->text)->withNumberPage($numberPage);
    }
    // public function search($text) {
    //     // $text_search =  $request->get('text');
        
    //     $posts = Post::where('body', 'LIKE', '%'.$text.'%')->orderBy('created_at', 'desc')->get();
    //     // dd($posts); 
    //     $numberPage = (int)($posts->count() / 4);
    //     $posts = $this->res->paginate($posts);

    //     return view('pages.search')->withPosts($posts)->withTextSearch($text)->withNumberPage($numberPage);
    // }

    public function index()
    {
        $data = [];
        $data1 = [];
        // $categories = Category::where('parent_id', null)->get();
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
        // $allnewList = Post::where('published', '=', true)->orderBy('created_at', 'desc')->skip(1)->take(4)->get();
        // dd($newList);    
        return view('pages.home')->withCategories($categories)->withData($data)->withData1($data1)->withNew($new)->withNewList($newList)->withNewsHot($newsHot);
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
            // $posts = MainService::paginate($posts);
            $posts = $this->res->paginate($posts);
            // $posts = $this->paginate($posts);

            $this->save = new Collection();
            $postsMostPopular = $this->getAllPostsBaseCategory($id)->sortByDesc('view')->take(4);
            $this->save = new Collection();


            $data = [];
            $data1 = [];
            $categories = Category::where('parent_id', '=', null)->take(4)->get();
            foreach ($categories as $key => $category) {
                $this->save = new Collection();
                $postsBaseCategory = $this->getAllPostsBaseCategory($category->id)->sortByDesc('created_at');
                $this->save = new Collection();
                if($postsBaseCategory->count() > 0 ) {
                    $data[$category->id] = $postsBaseCategory;
                }
              
                $data1[$category->id] = $postsBaseCategory->first();
            }



            return view('pages.posts_base_category')->withPosts($posts)->withCategory($category)->withPostsMostPopular($postsMostPopular)->withNumberPage($numberPage)->withData($data)->withData1($data1)->withCategories($categories);
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
                //increament view
                Event::fire('posts.view', $post);

                if(Auth::user()) {
                    $postAll = DB::table('posts')
                    ->leftJoin('storages', 'storages.post_id', '=', 'posts.id')
                    ->where('posts.slug', '=', $slug)
                    ->where('storages.user_id', '=', Auth::user()->id)
                    ->selectRaw('storages.*')
                    ->first();
                    
                    // dd($tags);
                    // $postAll->key = [
                    //     'key1' => 'value1',
                    //     'key2' => 'value2',
                    // ];
                    // dd($postAll);
                } 
                else {
                    $postAll = null;
                }

                $category = DB::table('category_post')
                        ->join('posts', 'category_post.post_id', '=', 'posts.id' )
                        ->join('categories', 'category_post.category_id', '=', 'categories.id' )
                        ->where('posts.id', '=', $post->id)
                        ->first();
                $category1 = Category::find($category->id);

                $this->save = new Collection();
                $postsRelated = $this->getAllPostsBaseCategory($category1->id)->sortByDesc('created_at')->take(4);
                $this->save = new Collection();
                //show tag of post
                $tags = DB::table('post_tag')
                    ->leftJoin('tags', 'tags.id', '=', 'post_tag.tag_id')
                    ->leftjoin('posts', 'posts.id', '=', 'post_tag.post_id')  
                    ->where('posts.id', '=', $post->id)
                    ->selectRaw('tags.*')->get();
                    // dd($this->res->getCommentBasePost($post));
                $comments = $this->res->getCommentBasePost($post);
                // dd($tags);           
                //show ds category :))
                $data = [];
                $data1 = [];
                $categories = Category::where('parent_id', '=', null)->paginate(4);
                foreach ($categories as $key => $category) {
                    $this->save = new Collection();
                    $posts = $this->getAllPostsBaseCategory($category->id)->sortByDesc('created_at');
                    $this->save = new Collection();
                    if($posts->count() > 0 ) {
                        $data[$category->id] = $posts;
                    }
                  
                    $data1[$category->id] = $posts->first();
                }

                return view('pages.single')->withPost($post)->withCategory($category1)->withPostsRelated($postsRelated)->withPost($post)->withPostAll($postAll)->withData($data)->withData1($data1)->withCategories($categories)->withTags($tags)->withComments($comments);
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

        return view('pages.posts_base_tag')->withPosts($posts)->withTag($tag)->withNumberPage($numberPage);

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
