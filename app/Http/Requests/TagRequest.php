<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;

class TagRequest extends FormRequest
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
            'name.required' => 'Tên của thẻ là bắt buộc!',
            'name.unique' => 'Tên của thẻ đã tồn tại!',
            'name.min' => 'Tên của thẻ ít nhất 3 kí tự!',
        ];
        return  Validator::make($request->all(), [
            'name' => 'required|min:3|unique:tags,name',
             ], $messages
         );
    }
}
