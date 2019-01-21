<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Http\Requests\TagRequest;
class TagController extends Controller
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
        $tags = Tag::paginate(8);
        
        return view('admin.tags.index')->withTags($tags);
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
        $validation = TagRequest::rules($request);

        if($validation->passes()){
            
            $tag = Tag::create($request->all());

            return response()->json([
                'message' => 'Tạo thẻ '.'<span style="color:green">'.$tag->name.'</span> thành công',
                'class_name'  => 'alert-success',
                'tag' => $tag,
            ]);
        }
        else{
            return response()->json([
            'message' => $validation->errors()->all(),
            'class_name'  => 'alert-success',
        ]);
        }
    }

    public function edit(Request $request)
    {
        $tag = Tag::find($request->id);
        return response()->json([
            'tag' => $tag,
        ]);
    }

    public function update(Request $request)
    {
        $validation = TagRequest::rules($request);

        if($validation->passes()){

            $tag = Tag::find($request->id);
            $tag->name = $request->name;
            $tag->save();
         
            return response()->json([
                'message' => 'Updated successfully',
                'class_name'  => 'alert-success',
                'tag' => $tag,
            ]);
        }

        else{
            return response()->json([
                'message' => $validation->errors()->all(),
                'class_name'  => 'alert-danger',
            ]); 
        }
    }

    public function destroy(Request $request)
    {
        $tag = Tag::find($request->id);
        $tag->posts()->detach();
        $tag->delete();
        return response()->json([
            'message' => 'Delete successfully',
            'class_name'  => 'alert-success',
            'tag' => $tag,
        ]);
    }
}
