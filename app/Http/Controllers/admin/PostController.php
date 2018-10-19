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


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        return $this->middleware('auth');
    }
    
    public function index()
    {
       
        $data['categoriesNoChildren']  = Category::getCategoryNoChildren()->get();
        // dd($data['categoriesNoChildren']->first()->name);
        // $data['categoriesNoChildren']->prepend('Choose');
        $data['trees'] = Category::where('parent_id',null)->get();
        $data['tags'] = Tag::all();
        
        return view('admin.posts.index', $data);
    }

    public function readData()
    {
        $posts = Post::join('users', 'users.id', '=', 'posts.user_id')
        ->selectRaw('posts.id, posts.title, posts.slug, posts.body, posts.image, posts.published, posts.vote, posts.view, users.name as username, posts.user_id')->orderBy('posts.id', 'asc')->get(); 
        // dd($posts->first());
        
        

        return view('admin.posts.post_info')->withPosts($posts);
    }

    public function test(){
        $category = Category::where('id', '=', '13')->firstOrFail();
        $id=0;
        // dd($category->parent()->count());
        while($category->parent()->count() > 0 )
        {
            $parent_category = Category::where('id', '=', $category->parent()->first()->id)->firstOrFail();
            $id+=1;
            $category = $parent_category;
            // $parent_category = Category::where('id', '=', $category->parent()->id)->firstOrFail();
            // $post->categories()->sync($parent_category, false);
            // $category = $parent_category;
        }
        dd($id);
    }
    // public function getCategoriesChildren($category_id){
    //     $category = Category::find($category_id);
    //     $sub_cats = $category->childrens()
    //                 ->select('id', 'name')->get();
    //     return response()->json($sub_cats);
    // }
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
        // $data = $request->get('arr');
        // $categories = implode(',', $data); //noi phan tu cua mang thanh 1 chuoi: null,1,2,3,,...

        return response()->json([
            'sub_cats' =>$sub_cats,
        ]);
    }

    // public function findCategory($id){
    //     if(Category::where('id',$id)->first()!=null){
    //      return 'hihi';
    //     }
    // }

    public function find($id){
        return Post::join('users', 'users.id', '=', 'posts.user_id')
        ->selectRaw('posts.id, posts.title, posts.slug, posts.body, posts.image, posts.published, posts.vote, posts.view, users.name as username')->where('posts.id',$id)->first();
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
        $validation = PostRequest::rules($request);
            
            if($validation->passes())
            {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $filename);


                // if($request->get('published') == ""){
                //     $published = false;
                // }
                // else{

                //     $published = $request->published;
                // }
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
                ]);

                if(!is_null($request->category)){
                    $category = Category::where('name', '=', $request->category)->firstOrFail();
                    $post->categories()->sync($category, false);
                    //them post vao tat ca category cha
                    // $category = Category::where('name', '=', $request->category)->firstOrFail();
                    //     $post->categories()->sync($category, false);
                    //     while($category->parent()->count() > 0  )
                    //     {
                    //         $parent_category = Category::where('id', '=', $category->parent()->first()->id)->firstOrFail();
                    //         $post->categories()->sync($parent_category, false);
                    //         $category = $parent_category;
                    //     }
                }
               if(!is_null($request->tags)){
                foreach ($request->tags as $value) {
                        $post->tags()->sync($value, false);
                    }
                }

               return response()->json([
               'message'   => 'The post was successfully save!',
               'uploaded_image' => '<img src="/images/'.$filename.'" class="img-thumbnail" width="300" />',
               'class_name'  => 'alert-success',
               'post_data'  => $this->find($post->id),
              ]);
             }

        else
        {
              return response()->json([
               // 'message'   => $request->published,
               'message'   => $validation->errors()->all(),
               // 'message'   => $validation->errors()->all(),
               'class_name'  => 'alert-danger'
              ]);
         }
        
    }
    // public function store(Request $request)
    // {
    //     // $validation = Validator::make($request->all(), [
    //     //     'title'       => 'required|max:255',
    //     //     'slug'        => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
    //     //     'body'         => 'required',
    //     //     'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     //      ]);
    //     //      
    //     $validation = PostRequest::rules($request);
    //         // $validation=$validated = $request->validated();

    //         // if(!$errors->any())
    //         if($validation->passes())
    //         // if($request->validated()->passes())
    //         {
    //             //creat post
    //             // $post=new Post;
    //             // $post->title= $request->title;
    //             // $post->slug= $request->slug;
    //             // $post->body= $request->body;
    //             // $image = $request->file('image');
    //             // $filename = time() . '.' . $image->getClientOriginalExtension();
    //             // $image->move(public_path('images'), $filename);
    //             // $post->image = $filename; 
    //             // if($request->get('published') == ""){

    //             // }
    //             // else{

    //             //     $post->published = $request->published;
    //             // }

    //             // $post->user_id = Auth::user()->id; 
    //             // $post->save();

    //             // foreach ($request->category_id as $value) {
    //             //     if(is_null($value)){}
    //             //     else
    //             //     {
    //             //     $post->categories()->sync($value, false);
    //             //     } 
    //             // }
    //             // $post->categories()->sync($request->sub_cat_id, false);
    //             //end create post
    //             //
    //             $image = $request->file('image');
    //             $filename = time() . '.' . $image->getClientOriginalExtension();
    //             $image->move(public_path('images'), $filename);


    //             if($request->get('published') == ""){
    //                 $published = false;
    //             }
    //             else{

    //                 $published = $request->published;
    //             }
    //             $post = Post::create([
    //                 'title' => $request->title,
    //                 'slug' => $request->slug,
    //                 'body' => $request->body,
    //                 'image' => $filename,
    //                 'published' => $published,
    //                 'user_id' => Auth::user()->id,
    //             ]);

    //             if(!is_null($request->category_id)){
    //                 foreach ($request->category_id as $value) {
    //                     $post->categories()->sync($value, false);
    //                 }
    //             }
    //            if(!is_null($request->sub_cat_id)){
    //             foreach ($request->sub_cat_id as $value) {
    //                     $post->categories()->sync($value, false);
    //                 }
    //             }

    //             // }
    //             // foreach ($request->category_id as $value) {
    //             //     if(is_null($value)){}
    //             //     else
    //             //     {
    //             //         $post->categories()->sync($value, false);
    //             //     } 
    //             // }
    //             // $post->categories()->sync($request->sub_cat_id, false);

    //             //end demo


    //             // $post->categories()->sync($request->categoriesegory_id, false);
    //             // $post->categories()->sync($request->sub_cat_id, false);
    //             // return response($request->category_id);
    //            return response()->json([
    //            'message'   => 'The post was successfully save!',
    //            'uploaded_image' => '<img src="/images/'.$filename.'" class="img-thumbnail" width="300" />',
    //            'class_name'  => 'alert-success',
    //            'post_data'  => $this->find($post->id),
    //           ]);
    //          }

    //     else
    //     {
    //           return response()->json([
    //            'message'   => $validation->errors()->all(),
    //            // 'message'   => $validation->errors()->all(),
    //            'class_name'  => 'alert-danger'
    //           ]);
    //      }
        
    // }

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
    // public function edit($id){
    //     // if($request->ajax()){
    //     //     $post = Post::find($request->id);
            
    //     //     return response($post);
    //     // }
    //     $post = Post::find($id);

    //     // categoriesNoChildren
    //     // dd($post->categories()->id);
    //     // $categoriesNoChildren=array();
    //     // $categoriesChilderen=array();
    //     // dd($post->categories);
    //     // foreach($post->categories as $category){
    //     //    // dd($category->parent->id);
    //     //         if(is_null($category->parent)){
    //     //              $categoriesNoChildren[$category->id] = $category->name;
    //     //          }
    //     //          else if(!is_null($category->parent)){
    //     //              $categoriesChilderen[$category->id] = $category->name;
                    
    //     //          }
    //     // }
    //     $categories = Category::all();
    //     foreach($categories as $category){
    //                  $categories[$category->id] = $category->name;
    //     }
    //     //dd($categoriesNoChildren);
    //     // dd($categoriesChilderen);


    //      return view('admin.posts.edit')->withPost($post)->withCategories($categories);
    // }


     public function edit($id) 
    {

            $post = Post::find($id);
            $tags = Tag::all();

            foreach($tags as $tag){

                         $tags[$tag->id] = $tag->name;
            }
            $tags[0] = "";
            $trees = Category::where('parent_id',null)->get();
            //lay name category be nhat cua bai post nay trong csdl
            if($post->categories()->count() > 0 )
            {
                $cat = $post->categories()->first();
             return view('admin.posts.edit')->withPost($post)->withTags($tags)->withCategory($cat->name)->withTrees($trees);

            }
            else{

             return view('admin.posts.edit')->withPost($post)->withTags($tags)->withCategory(null)->withTrees($trees);
            }
            
     }

    // public function edit($id) 
    // {

    //         $post = Post::find($id);
    //         $tags = Tag::all();

    //         foreach($tags as $tag){

    //                      $tags[$tag->id] = $tag->name;
    //         }
    //         $tags[0] = "";
    //         $trees = Category::where('parent_id',null)->get();
    //         //lay name category be nhat cua bai post nay trong csdl
    //         if($post->categories()->count() > 0 )
    //         {
    //             $id = 0;
    //             // dd($post->categories()->first()->id);
    //             foreach($post->categories()->get() as $category)
    //             {

    //                 foreach($post->categories()->get() as $category1)
    //                 {
    //                     if($category1->parent_id == $category->id){
    //                         $id += 1;
    //                     }

                            
    //                 }

    //                 if($id == 0){

    //                     $cat = $category;
    //                     break;
    //                 }
    //                 else
    //                 {
    //                     $id = 0;
    //                 }

    //             }

    //          return view('admin.posts.edit')->withPost($post)->withTags($tags)->withCategory($cat->name)->withTrees($trees);

    //         }
    //         else{

    //          return view('admin.posts.edit')->withPost($post)->withTags($tags)->withCategory(null)->withTrees($trees);
    //         }
            
    //  }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     dd('hihi');
    // }
    // 
     public function update(Request $request)
    {
        $validation = PostRequest::rulesUpdate($request);

        if($validation->passes()){
                // $image = $request->file('image');
                // $filename = time() . '.' . $image->getClientOriginalExtension();
                // $image->move(public_path('images'), $filename);
                $post= Post::find($request->id);
                $post->title = $request->title;
                $post->slug = $request->slug;
                $post->body = rtrim($request->body);
                // $post->body = trim($request->body);
                if($request->hasFile('image')){
                    $image = $request->file('image');
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images'), $filename);
                    //xoa anh cu
                    $oldFilename = $post->image;
                    File::delete('images/'.$oldFilename);
                    $post->image = $filename; 
                }
                // $post->image=$request->image;

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

                    //cap nhat tat ca cac category cha
                    // $category = Category::where('name', '=', $request->category)->firstOrFail();
                    //     $post->categories()->sync($category, false);
                    //     while($category->parent()->count() > 0  )
                    //     {
                    //         $parent_category = Category::where('id', '=', $category->parent()->first()->id)->firstOrFail();
                    //         $post->categories()->sync($parent_category, false);
                    //         $category = $parent_category;
                    //     }
                }
                $post->tags()->detach();
                //update tags
               if(!is_null($request->tags)){
                foreach ($request->tags as $value) {
                        $post->tags()->sync($value, false);
                    }
                }

                return response()->json([
                'message1' => $_POST[ 'body_hidden' ],
                'message'   => 'The post was successfully updated!',
                // 'message'   => $post,
                'class_name'  => 'alert-success',
            ]);
        }
        else
        {
            return response()->json([
                'message1' => $request->tags,
                'message'   =>  $validation->errors()->all(),
                'class_name'  => 'alert-success',
            ]);
        }
        
    }

    // public function update(Request $request)
    // {
    //     $validation = PostRequest::rulesUpdate($request);
    //     if($validation->passes()){
    //             // $post=new Post;
    //             // $post->title= $request->title;
    //             // $post->slug= $request->slug;
    //             // $post->body= $request->body;
    //             $post= Post::find($request->id);

    //             if($request->get('published') == ""){

    //             }
    //             else{

    //                 $post->published = $request->published;
    //             }
    //             $post->title = $request->title;
    //             $post->slug = $request->slug;
    //             $post->body = $request->body;
    //             if($request->hasFile('image')){
    //                 $image = $request->file('image');
    //                 $filename = time() . '.' . $image->getClientOriginalExtension();
    //                 $image->move(public_path('images'), $filename);
    //                 //xoa anh cu
    //                 $oldFilename = $post->image;
    //                 File::delete('images/'.$oldFilename);
    //                 $post->image = $filename; 
    //             }
    //             // $post->image=$request->image;
    //             $post->user_id = $request->user_id;
    //             $post->save();
    //             //xoa category_post va update
    //             $post->categories()->detach();

    //             foreach ($request->categories as $value) {
    //                 if(is_null($value)){}
    //                 else
    //                 {
    //                     $post->categories()->sync($value, false);
    //                 } 
    //             }
    //             // $post->categories()->sync($request->sub_cat_id, false);
    //             return response()->json([
    //             'post_data' => 'thanh cong',
    //             'message'   => 'The post was successfully updated!',
    //             // 'message'   => $post,
    //             'class_name'  => 'alert-success',
    //         ]);
    //     }
    //     else
    //     {
    //         return response()->json([
    //             'post_data' => 'that bai',
    //             'message'   =>  $validation->errors()->all(),
    //             'class_name'  => 'alert-success',
    //         ]);
    //     }
        
    // }
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
            // C1: if($user->can('delete', $post)){
            if(Gate::allows('post.delete', $post)) {
            // if(Gate::allows('post.delete', $post)) {
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
        // else{
        //     return response()->jsonn([
        //         'message' => 'hihi',
        //     ]);
        // }
        // $id=Input::get('id');
        return response()->json([
                'message' => 'Ajax loi',
        ]);
    }
}
