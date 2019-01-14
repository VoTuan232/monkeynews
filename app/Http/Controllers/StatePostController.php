<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Auth;
use DB;

class StatePostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function likePost(Request $request) {

        if(is_null(Auth::user())) {
            return response()->json([
                'authenticated' => __('language.check_login_like_post'),
                'class_name' => 'alert-danger',
            ]);
        }
        else {

            $post = Post::find($request->id);
            
            if(DB::table('storages')->where([
                'post_id' => $post->id,
                'user_id' => Auth::user()->id,
                'like' => 0,
            ])->exists()) {
                $post->dislike -=1;
            }
            $post->like +=1;
            $post->save();


            if(DB::table('storages')->where([
                'post_id' => $post->id,
                'user_id' => Auth::user()->id,
            ])->exists()) {
                DB::table('storages')->where([
                    ['user_id', '=', Auth::user()->id],
                    ['post_id', '=', $post->id],
                    ])->update([
                        'like' => 2, 
                ]);

            }

            else {
                DB::table('storages')->insert([
                    'post_id' => $post->id,
                    'user_id' => Auth::user()->id,
                    'like' => 2,
                ]);
            }

            return response()->json([
                'message' => __('language.like_post_success'),
                'class_name' => 'alert-success',
                'post_data' => $post,
            ]); 
        }

    }

    public function removeLikePost(Request $request) {
            $post = Post::find($request->id);

            $post->like -=1;
            $post->save();

            DB::table('storages')->where([
                ['user_id', '=', Auth::user()->id],
                ['post_id', '=', $post->id],
            ])->update([
                'like' => 1, 
            ]);
            
            return response()->json([
                'message' => __('language.remove_like_post_success'),
                'class_name' => 'alert-success',
                'post_data' => $post,
            ]); 
    }

    public function dislikePost(Request $request) {

        if(is_null(Auth::user())) {
            return response()->json([
                'authenticated' => __('language.check_login_dislike_post'),
                'class_name' => 'alert-danger',
            ]);
        }
        else {

            $post = Post::find($request->id);

            if(DB::table('storages')->where([
                'post_id' => $post->id,
                'user_id' => Auth::user()->id,
                'like' => 2,
            ])->exists()) {
                $post->like -=1;
            }
            $post->dislike +=1; //dislike or like: 1 trong 2 lua chon
            $post->save();

            if(DB::table('storages')->where([
                'post_id' => $post->id,
                'user_id' => Auth::user()->id,
            ])->exists()) {
                DB::table('storages')->where([
                    ['user_id', '=', Auth::user()->id],
                    ['post_id', '=', $post->id],
                    ])->update([
                        'like' => 0, 
                ]);

            }

            else {
                DB::table('storages')->insert([
                    'post_id' => $post->id,
                    'user_id' => Auth::user()->id,
                    'like' => 0,
                ]);
            }

            return response()->json([
                'message' => __('language.dislike_post_success'),
                'class_name' => 'alert-success',
                'post_data' => $post,
            ]); 
        }

    }

    public function removeDislikePost(Request $request) {
            $post = Post::find($request->id);

            $post->dislike -=1;
            $post->save();

            DB::table('storages')->where([
                ['user_id', '=', Auth::user()->id],
                ['post_id', '=', $post->id],
            ])->update([
                'like' => 1, 
            ]);
            
            return response()->json([
                'message' => __('language.remove_dislike_post_success'),
                'class_name' => 'alert-success',
                'post_data' => $post,
            ]); 
    }
}
