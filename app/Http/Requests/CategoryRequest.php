<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;
use App\Models\Category;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules($request)
    {
         $messages = [
            'name.required' => 'Tên của chủ đề là bắt buộc!',
            'name.unique' => 'Tên chủ đề đã tồn tại!',
        ];
        return  Validator::make($request->all(), [
            'name' => 'required|unique:categories,name',
             ], $messages
         );
    }

    public static function rulesUpdate($request)
    {
        $category = Category::find($request->id);

        $messages2 = [
            'name.required' => 'Tên của chủ đề là bắt buộc!',
            'name.unique' => 'Tên chủ đề đã tồn tại!',
        ];
        $messages1 = [
            'name.required' => 'Tên của chủ đề là bắt buộc!',
        ];

        if($category->name == $request->name){
        return  Validator::make($request->all(), [
            'name' => 'required',
             ], $messages1
         );
        }
        else if($category->name != $request->name){
            return  Validator::make($request->all(), [
            'name' => 'required|unique:categories,name',
             ], $messages2
         );
         }
    }
}
