<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function search(){
    //     $term = Request::get('q');
        
    //     $results = array();
        
    //     $queries = DB::table('categories')
    //         ->where('name', 'LIKE', '%'.$term.'%')
    //         ->take(5)->get();
        
    //     foreach ($queries as $query)
    //     {
    //         $results[] = [ 'id' => $query->id, 'value' => $query->name ];
    //     }
    //     return Response::json($results);
    // }
    // function search(Request $request)
    // {
    //      if($request->get('query'))
    //      {
    //       $query = $request->get('query');
    //       $data = DB::table('categories')
    //         ->where('name', 'LIKE', "%{$query}%")
    //         ->get();
    //       $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
    //       foreach($data as $row)
    //       {
    //        $output .= '
    //        <li><a href="#">'.$row->name.'</a></li>
    //        ';
    //       }
    //       $output .= '</ul>';
    //       echo $output;
    //    }
    // }

    // public function test(){
        
    //     $categories = Category::where('parent_id',null)->get();
    //     // dd($categories);
    //     // $categories = Category::select('id', 'parent_id', 'name')->get()->toArray();
    //     return view('admin.categories.test', compact('categories'));
    // }
    public function __construct() {
        return $this->middleware('auth');
    }


    public function index()
    {
        $categories = Category::all();
        $categoriesNoChildren = Category::getCategoryNoChildren()->get();
        // dd($categories);
        $trees = Category::where('parent_id',null)->get();
        return view('admin.categories.index')->withCategories($categories)->withCategoriesNoChildren($categoriesNoChildren)->withTrees($trees);
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

 //su dung ajax   
    // public function store(Request $request)
    // {
    //     $validation = CategoryRequest::rules($request);

    //     if($validation->passes()){
    //         if(is_null($request->parent_id)){
    //             $category = Category::create([
    //                 'name' => $request->name,
    //             ]);
    //         }
    //         else {
    //             $parent_id = Category::select('id', 'name')->where('name', $request->parent_id)->first();;
    //             $category = Category::create([
    //                 'name' => $request->name,
    //                 'parent_id' => $parent_id->id,
    //             ]);
    //         }
    //         return response()->json([
    //             'message' => 'Tạo chủ đề '.'<span style="color:yellow">'.$category->name.'</span> thành công',
    //             'class_name'  => 'alert-success',
    //             'category' => $category,
    //             'parent_name' => isset($parent_id) ? $parent_id->name : "null",
            
    //         ]);
    //     }
    //     else{
    //         return response()->json([
    //         'message' => $validation->errors()->all(),
    //         'class_name'  => 'alert-danger',

    //     ]);
    //     }
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
    public function edit(Request $request)
    {
        $category = Category::find($request->id);

        if(!is_null($category->parent_id))
        {
            $parent = Category::where('id', '=', $category->parent_id)->first();
            $parent_name = $parent->name;
        }
        // $category = Category::find($request->id);
        return response()->json([
            'category' => $category,
            // 'message' => $request->all(),
            'parent_name' => isset($parent_name) ? $parent_name : "null",
        ]);
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
        $validation = CategoryRequest::rulesUpdate($request);

        if($validation->passes()){

            $category = Category::where('id', '=', $request->id)->first();
            $category->name = $request->name;

            if($request->parent_name != null)
            {
                // $category->parent_id = "null";
                $parent = Category::where('name', '=', $request->parent_name)->first();
                if($parent->id == $category->id){
                    return response()->json([
                        'message' => 'Không thể chọn chuyên đề cha là chính mình',
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
                // 'message' => $request->all(),
                'class_name'  => 'alert-success',
                'category' => $category,
                'parent_name' => isset($parent) ? $parent->name : "null",
            
            ]);
            // return response()->json([
            //     'message' => $request->parent_name,
            // ]);
        }
        return response()->json([
                'message' => $validation->errors()->all(),
                // 'message' => $request->id,
                'class_name'  => 'alert-danger',
                // 'category' => $category,
                // 'parent_name' => $parent_id->name,
            
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
            // 'message' => $tag
            'message' => 'Delete successfully',
            'class_name'  => 'alert-success',
            'category' => $category,
        ]);
    }
}
