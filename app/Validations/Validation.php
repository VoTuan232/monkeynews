<?php

namespace App\Validations;
use Validator;

class Validation
{
    public static function validateSignupRequest($request)
    {
        return Validator::make($request->all(), [
            'title'       => 'required|max:255',
            'slug'        => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'body'         => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
             ]);
    }
}
