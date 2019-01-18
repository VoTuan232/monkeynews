<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Input; 
use Validator;
use Auth;
use App\Repositories\UserRepository;
use File;
use Illuminate\Support\Facades\Hash;
use JD\Cloudder\Facades\Cloudder;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function updateProfile(Request $request) {

        $validation = Validator::make($request->all(), [
              'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
             ]);

        if($validation->passes())
            {
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $filename = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move('images/users', $filename);
                    // $image->move(public_path('images/users'), $new_name);

                    //remove old file
                    $oldFilename = Auth::user()->avatar;
                    if($oldFilename != null) {
                        File::delete('images/users/'.$oldFilename);
                    }

                    //upload cloud
                  Cloudder::upload('images/users/' . $filename);
                  //get url cloudder image
                  // dd(Cloudder::getResult());
                  //update image thanh url of cloudder
                  $url_image_cloudder = Cloudder::getResult()['url'];

                    //update
                    $data['avatar'] = $url_image_cloudder;
                    // $data['avatar'] = $new_name;
                    $this->userRepository->update($data, Auth::user()->id);
                }

                return response()->json([
                   'message'   => 'Update Profile Successfully',
                   'uploaded_image' => '',
                   'alert_type'  => 'success'
                ]);
             }
        else
            {
              return response()->json([
               'message'   => $validation->errors()->all(),
               'uploaded_image' => '',
               'alert_type'  => 'error'
              ]);
            }
    }
}
