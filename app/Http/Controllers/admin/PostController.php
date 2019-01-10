<?php

namespace App\Http\Controllers\admin;

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
use Event;
use App\Events\NewPost;
use Session;
use Carbon;
use App\Repositories\TagRepository;

class PostController extends Controller
{
    private $res;
    private $tags;

    private $tagRepository;

    public function __construct(TagRepository $tagRepository) {
        $this->middleware('auth');
        $this->tagRepository = $tagRepository;
    }
    
   
    public function index()
    {
     
        $data['categoriesNoChildren']  = Category::getCategoryNoChildren()->get();
        $data['trees'] = Category::where('parent_id',null)->get();

        $tags = $this->tagRepository->getAllTag();

        return view('admin.posts.index', $data)->withTags($tags);
    }

    public function readData()
    {
        $posts = Post::join('users', 'users.id', '=', 'posts.user_id')
        ->selectRaw('posts.id, posts.title, posts.slug, posts.body, posts.image, posts.published, posts.like,posts.dislike, posts.view, users.name as username, posts.user_id')->orderBy('posts.id', 'desc')->get(); 

        return view('admin.posts.post_info')->withPosts($posts);
    }

    public function test(){
        $category = Category::where('id', '=', '13')->firstOrFail();
        $id=0;
        while($category->parent()->count() > 0 )
        {
            $parent_category = Category::where('id', '=', $category->parent()->first()->id)->firstOrFail();
            $id+=1;
            $category = $parent_category;
        }
        dd($id);
    }
    
    public function getCategoriesChildren(Request $request) {
        
        $sub_cats=array();

        foreach($request->get('arr') as $category_id)
        {
            if(is_numeric($category_id))
            {
                $category = Category::where('id', '=', $category_id)->first();
                $subCategories = $category->childrens()
                ->select('id', 'name')->get();
                array_push($sub_cats, $subCategories);
            }
            
        }

        return response()->json([
            'sub_cats' =>$sub_cats,
        ]);
    }


    public function find($id){
        return Post::join('users', 'users.id', '=', 'posts.user_id')
        ->selectRaw('posts.id, posts.title, posts.slug, posts.body, posts.image, posts.published, posts.like, posts.dislike, posts.view, users.name as username')->where('posts.id',$id)->first();
    }
    
    public function store(Request $request)
    {
        $validation = PostRequest::rules($request);
        
        if($validation->passes())
        {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);


            if(is_null($request->published)){
                $published = false;

            }
            else{

                $published = $request->published;
            }
            $post = Post::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'body' => trim($request->body),
                'image' => $filename,
                'published' => $published,
                'user_id' => Auth::user()->id,
                'request' => 0,

            ]);
            //send mail
            //event(new NewPost($post));

            if(!is_null($request->category)){
                $category = Category::where('name', '=', $request->category)->firstOrFail();
                $post->categories()->sync($category, false);
            }
            if(!is_null($request->tags)){
                foreach ($request->tags as $value) {
                    $post->tags()->sync($value, false);
                }
            }

            return response()->json([
             'message'   => 'The post was successfully save!',
             // 'uploaded_image' => '<img src="/images/'.$filename.'" class="img-thumbnail" width="300" />',
             'class_name'  => 'alert-success',
             'post_data'  => $this->find($post->id),
         ]);
        }

        else
        {
          return response()->json([
             'message'   => $validation->errors()->all(),
             'class_name'  => 'alert-danger'
         ]);
      }
      
  }
  
    public function edit($id) 
    {
        $post = Post::find($id);
        $tags = Tag::all();

        foreach($tags as $tag){

           $tags[$tag->id] = $tag->name;
        }
       $tags[0] = "";
       $trees = Category::where('parent_id',null)->get();
       if($post->categories()->count() > 0 )
       {
        $cat = $post->categories()->first();
        $category = $cat->name;

        return view('admin.posts.edit', compact('post', 'tags', 'category', 'trees'));
        }
        else{
            $category = null;

            return view('admin.posts.edit', compact('post', 'tags', 'category', 'trees'));
        }
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validation = PostRequest::rulesUpdate($request);

        if($validation->passes()){
          
            $post= Post::find($request->id);
            $post->title = $request->title;
            $post->slug = str_slug($request->title);
            // $post->slug = $request->slug;
            $post->body = rtrim($request->body);
            if($request->hasFile('image')){
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $filename);
                $oldFilename = $post->image;
                File::delete('images/'.$oldFilename);
                $post->image = $filename; 
            }

            if(is_null($request->published)){
                $published = false;
            }
            else{

                $published = $request->published;
            }
            $post->published = $published;
            $post->save();
            $post->categories()->detach();
            if(!is_null($request->category)){
                $category = Category::where('name', '=', $request->category)->firstOrFail();
                $post->categories()->sync($category, false);            
            }
            $post->tags()->detach();
            if(!is_null($request->tags)){
                foreach ($request->tags as $value) {
                    $post->tags()->sync($value, false);
                }
            }

            return response()->json([
                'message'   => 'The post was successfully updated!',
                'class_name'  => 'alert-success',
            ]);
        }
        else
        {
            return response()->json([
                'message'   =>  $validation->errors()->all(),
                'class_name'  => 'alert-success',
            ]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        if($request->ajax()){
            $post = Post::find($request->id);
            if(Gate::allows('post.delete', $post)) {
                $post->categories()->detach();
                $post->delete();
                return response()->json([
                    'success' => 'have authorization',
                    'message' => 'Delete post successfully',
                    'class_name' => 'alert-success',

                ]);

            }
            else{

                return response()->json([

                    'message' => 'Bạn không có quyền!',
                    'class_name' => 'alert-success',
                ]);
            }
        }
        
        return response()->json([
            'message' => 'Ajax loi',
        ]);
    }

    public function getTrending(Post $post) {
        $post->update([
            'trending' => Carbon\Carbon::now(),
        ]);
        return redirect()->back();
    }

    
}
