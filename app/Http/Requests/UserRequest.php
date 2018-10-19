<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;
use App\Models\User;

class UserRequest extends FormRequest
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
            'name.required' => 'Tên người dùng là bắt buộc!',
            'email.required' => 'Email người dùng là bắt buộc!',
            'email.unique' => 'Email đã tồn tại!',
            'password.required' => 'Mật khẩu là bắt buộc!',
            'password.min' => 'Mật khẩu cần tối thiểu 6 kí tự!',
            'password.confirmed' => 'Mật khẩu không trùng khớp!',
        ];
        return  Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
             ], $messages
         );
    }

     public static function rulesUpdate($request)
    {
        $messages = [
            'name.required' => 'Tên người dùng là bắt buộc!',
            'email.required' => 'Email người dùng là bắt buộc!',
            'email.unique' => 'Email đã tồn tại!',
            'password.min' => 'Mật khẩu cần tối thiểu 6 kí tự!',
        ];

        $user = User::find($request->user_id);

        if($user->email == $request->email) {
            
            return  Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'string|email|max:255',
                'password' => 'string|min:6',
                 ], $messages
             );
        }

        else if($user->email != $request->email){
            
            return  Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'string|min:6',
                 ], $messages
             );
        }
    }
}
