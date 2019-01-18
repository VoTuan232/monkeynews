<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use DB;
use Auth;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Config; 
use Event;
use Session;
use App;
use App\Repositories\CategoryRepository;
use App\Repositories\TagRepository;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Storage;
use File;
use GuzzleHttp\Client;
use Gmopx\LaravelOWM\LaravelOWM;

class HomeController extends Controller
{
    public  $save;
    private $paginate;
    private $catsHome;

    private $categoryRepository;
    private $tagRepository;
    private $postRepository;

    public function __construct(
        CategoryRepository $categoryRepository, 
        TagRepository $tagRepository,
        PostRepository $postRepository,
        Category $cat)
    {
        $this->middleware('checkviewpost');
        $this->save = new Collection();
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
        $this->postRepository = $postRepository;
    }

    public function getSearch(Request $request) {
        $posts = Post::where('body', 'LIKE', '%'.$request->text.'%')->where('published', '=', true)->orderBy('created_at', 'desc')->paginate(4);
        $posts->appends($request->only('text'));
        $textSearch = $request->text;
        $catsHome = $this->categoryRepository->getCategoryForHome();
        $tags = $this->tagRepository->getAllTag();

        $trending = Post::orderBy('trending', 'desc')->firstOrFail();

        return view('pages.search', compact('posts', 'textSearch', 'catsHome', 'tags', 'trending'));
    }

    public function index()
    {
        // $lowm = new LaravelOWM();
        // $current_weather = $lowm->getCurrentWeather('london');

        // dd($current_weather->temperature->now->value);


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
        $catsHome = $this->categoryRepository->getCategoryForHome();

        // DB::table('posts')->update(['trending' => null]);
        // lay trending
        $trending = Post::where('published', true)->WhereNotNull('trending')->orderBy('trending', 'desc')->first();
        if($trending == null) {
            $trending = Post::where('published', true)->orderBy('created_at', 'desc')->firstOrFail();
        }

        return view('pages.home', compact('categories', 'data', 'data1', 'new', 'newList', 'newsHot', 'tags', 'catsHome', 'trending'));
    }

    public function getPosts($id, $slug) {
            $category = Category::find($id);
            $this->save = new Collection();
            $posts = $this->getAllPostsBaseCategory($id)->sortByDesc('created_at');
            $this->save = new Collection();
            $numberPage = (int)($posts->count() / 4);
            $posts = $this->categoryRepository->paginate($posts);
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

            $tags = $this->tagRepository->getAllTag();
            $catsHome = $this->categoryRepository->getCategoryForHome();

            // lay trending
            $trending = Post::where('published', true)->WhereNotNull('trending')->orderBy('trending', 'desc')->first();
            if($trending == null) {
                $trending = Post::where('published', true)->orderBy('created_at', 'desc')->firstOrFail();
            }

            return view('pages.posts_base_category', compact('posts', 'category', 'postsMostPopular', 'numberPage', 'data', 'data1', 'categories', 'tags', 'catsHome', 'trending'));
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
                // dd($postAll);
            } 
            else {
                $postAll = null;
            }

            // dd('hihi');

            // $category = DB::table('category_post')
            //         ->join('posts', 'category_post.post_id', '=', 'posts.id' )
            //         ->join('categories', 'category_post.category_id', '=', 'categories.id' )
            //         ->where('posts.id', '=', $post->id)
            //         ->first();
            // $category = Category::find($category->id);

            $category = $post->categories()->first();

            $this->save = new Collection();
            $postsRelated = $this->getAllPostsBaseCategory($category->id)->sortByDesc('created_at')->take(4);
            $this->save = new Collection();
            $tagsPost = DB::table('post_tag')
                ->leftJoin('tags', 'tags.id', '=', 'post_tag.tag_id')
                ->leftjoin('posts', 'posts.id', '=', 'post_tag.post_id')  
                ->where('posts.id', '=', $post->id)
                ->selectRaw('tags.*')->get();

            // $comments = $this->postRepository->getCommentBasePost($post);
            // dd($post->comments()->count());

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
            $tags = $this->tagRepository->getAllTag();
            $catsHome = $this->categoryRepository->getCategoryForHome();

            // lay trending
            $trending = Post::where('published', true)->WhereNotNull('trending')->orderBy('trending', 'desc')->first();
            if($trending == null) {
                $trending = Post::where('published', true)->orderBy('created_at', 'desc')->firstOrFail();
            }

            //random anh
            $files = File::allFiles('images/single_post');
            $randomFile = array_random($files);
            $imageName = $randomFile->getFilename();

            return view('pages.single', compact('post', 'category', 'postsRelated', 'postAll', 'data', 'data1', 'categories', 'tags', 'catsHome', 'tagsPost', 'trending', 'imageName'));
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
        $posts = $this->postRepository->paginate($posts);

        $tags = $this->tagRepository->getAllTag();
        $catsHome = $this->categoryRepository->getCategoryForHome();

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
        $trending = Post::where('published', true)->WhereNotNull('trending')->orderBy('trending', 'desc')->first();
        if($trending == null) {
            $trending = Post::where('published', true)->orderBy('created_at', 'desc')->firstOrFail();
        }

        return view('pages.posts_base_tag')->withPosts($posts)->withTag($tag)->withNumberPage($numberPage)->withTags($tags)->withCatsHome($catsHome)->withData($data)->withData1($data1)->withCategories($categories)->withTrending($trending);
    }

    public function getPostTrending() {
        $tags = $this->tagRepository->getAllTag();
        $catsHome = $this->categoryRepository->getCategoryForHome();
        // lay trending
        $trending = Post::where('published', true)->WhereNotNull('trending')->orderBy('trending', 'desc')->first();
        if($trending == null) {
            $trending = Post::where('published', true)->orderBy('created_at', 'desc')->firstOrFail();
        }

        $trending_list = Post::WhereNotNull('trending')->orderBy('trending', 'desc')->with('tags', 'comments')->paginate(5);
        //random anh
        $files = File::allFiles('images/single_post');
        $randomFile = array_random($files);
        $imageName = $randomFile->getFilename();

       return view('pages.trending', compact('catsHome', 'trending', 'tags', 'trending_list', 'imageName'));
    }
}
