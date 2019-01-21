<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
  
    public function __construct() {
        return $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::paginate(8);
        $categoriesNoChildren = Category::getCategoryNoChildren()->get();
        $trees = Category::where('parent_id',null)->get();

        return view('admin.categories.index', compact('categories', 'categoriesNoChildren', 'trees'));
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
        $validation = CategoryRequest::rules($request);

        if($validation->passes()){
            if(is_null($request->parent_id)){
                $category = Category::create([
                    'name' => $request->name,
                ]);
            }
            else {
                $parent_id = Category::select('id', 'name')->where('name', $request->parent_id)->first();;
                $category = Category::create([
                    'name' => $request->name,
                    'parent_id' => $parent_id->id,
                ]);
            }
            return response()->json([
                'message' => 'Tạo chủ đề '.'<span style="color:yellow">'.$category->name.'</span> thành công',
                'class_name'  => 'alert-success',
                'category' => $category,
                'parent_name' => isset($parent_id) ? $parent_id->name : "null",
            
            ]);
        }
        else{
            
            return response()->json([
                'message' => $validation->errors()->all(),
                'class_name'  => 'alert-danger',

            ]);
        }
    }

    public function edit(Request $request)
    {
        $category = Category::find($request->id);

        if(!is_null($category->parent_id))
        {
            $parent = Category::where('id', '=', $category->parent_id)->first();
            $parent_name = $parent->name;
        }
        return response()->json([
            'category' => $category,
            'parent_name' => isset($parent_name) ? $parent_name : "null",
        ]);
    }

    public function update(Request $request)
    {
        $validation = CategoryRequest::rulesUpdate($request);

        if($validation->passes()){

            $category = Category::where('id', '=', $request->id)->first();
            $category->name = $request->name;

            if($request->parent_name != null)
            {
                $parent = Category::where('name', '=', $request->parent_name)->first();
                if($parent->id == $category->id){
                    return response()->json([
                        'message' => 'Không thể chọn chủ đề cha là chính mình',
                        'class_name'  => 'alert-danger',
                    ]);
                }
                $category->parent_id = $parent->id;
            }
            else if($request->parent_name == null) {

                $category->parent_id = null;
            }

            $category->save();

            return response()->json([
                'message' => 'Updated category '.'<span style="color:green">'.$category->name.'</span> success',
                'class_name'  => 'alert-success',
                'category' => $category,
                'parent_name' => isset($parent) ? $parent->name : "null",
            
            ]);
        }
        return response()->json([
                'message' => $validation->errors()->all(),
                'class_name'  => 'alert-danger',
            
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $category = Category::find($request->id);
        $category->posts()->detach();
        $category->delete();
        return response()->json([
            'message' => 'Delete successfully',
            'class_name'  => 'alert-success',
            'category' => $category,
        ]);
    }
}
