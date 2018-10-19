<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    
    //xacs ddinh neu user co quyen request nay
    public function authorize()
    {
    //     $commentId = $this->route('comment');

    // return Comment::where('id', $commentId)
    //     ->where('user_id', Auth::id())->exists();
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            return [
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ];
        
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is bat buoc!',
            'password.required' => 'Password is bat buoc!'
        ];
    }

    //filters, fomart request data truoc khi validator
     public function filters()
    {
        return [
            'email' => 'trim|lowercase',
        ];
    }
}
