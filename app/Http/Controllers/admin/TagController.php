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
        $tags = Tag::all();
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
            
            // $name = $request->name;
            $tag = Tag::create($request->all());

            return response()->json([
                'message' => 'Tạo thẻ '.'<span style="color:green">'.$tag->name.'</span> thành công',
                'class_name'  => 'alert-success',
                'tag' => $tag,

            ]);
        }
        else{
            return response()->json([
            // 'message' => $request->all(),
            'message' => $validation->errors()->all(),
            'class_name'  => 'alert-success',

        ]);
        }
    }

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
        $tag = Tag::find($request->id);
        return response()->json([
            'tag' => $tag,
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
        $validation = TagRequest::rules($request);

        if($validation->passes()){

            $tag = Tag::find($request->id);
            $tag->name = $request->name;
            $tag->save();
            // $tag->posts()->detach();
            // $tag->delete();
            return response()->json([
                // 'message' => $tag,
                'message' => 'Updated successfully',
                'class_name'  => 'alert-success',
                'tag' => $tag,
            ]);
        }

        else{
            return response()->json([
                // 'message' => $tag,
                'message' => $validation->errors()->all(),
                'class_name'  => 'alert-danger',
                // 'tag' => $tag,
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
        $tag = Tag::find($request->id);
        $tag->posts()->detach();
        $tag->delete();
        return response()->json([
            // 'message' => $tag
            'message' => 'Delete successfully',
            'class_name'  => 'alert-success',
            'tag' => $tag,
        ]);
    }
}
