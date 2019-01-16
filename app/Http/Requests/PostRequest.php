<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use  Validator;
use App\Models\Post;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rulesTest()
    {
        return [
            'title'       => 'required|max:255',
            'slug'        => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'body'         => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public static function rules($request)
    {
        $messages = [
            'title.required' => 'Tiêu đề bắt buộc!',
            'body.required' => 'Nội dung bài viết bắt buộc!',
            'title.max' => 'Tiêu đề cần ít hơn 255 kí tự!',
            'slug.required' => 'Slug là bắt buộc!',
            'slug.min' => 'Slug có độ dài ít nhất là 5!',
            'slug.unique' => 'Slug đã tồn tại!',
            'image.required' => 'Ảnh là bắt buộc!',
        ];
        return  Validator::make($request->all(), [
            'title'       => 'required|max:255',
            'slug'        => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'body'         => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
             ], $messages
         );
    }

    public static function rulesUpdate($request)
    {
        $messages = [
            'title.required' => 'Tiêu đề bắt buộc!',
            'body.required' => 'Nội dung bài viết bắt buộc!',
            'title.max' => 'Tiêu đề cần ít hơn 255 kí tự!',
            'slug.required' => 'Slug là bắt buộc!',
            'slug.min' => 'Slug có độ dài ít nhất là 3!',
            'slug.unique' => 'Slug đã tồn tại!',
            'image.required' => 'Ảnh là bắt buộc!',
        ];

        $post = Post::find($request->id);
        if($post->slug == $request->slug){
            
            return  Validator::make($request->all(), [
                'title'       => 'required|max:255',
                'slug'        => 'required|alpha_dash|min:5|max:255',
                'body'         => 'required',
                'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
                 ], $messages
             );
        }

        else if($post->slug != $request->slug){
            
            return  Validator::make($request->all(), [
                'title'       => 'required|max:255',
                'slug'        => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'body'         => 'required',
                'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
                 ], $messages
             );
        }
    }

}
