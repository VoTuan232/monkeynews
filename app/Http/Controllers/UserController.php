<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Input; 
use Validator;
use Auth;
use App\Repositories\UserRepository;
use File;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function profile()
    {
        $user = Auth::user();

        return view('users.profile',compact('user'));
    }

    public function updateProfile(Request $request) {

        $validation = Validator::make($request->all(), [
              'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
             ]);

        if($validation->passes())
            {
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $new_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images/users'), $new_name);
                    //remove old file
                    $oldFilename = Auth::user()->avatar;
                    if($oldFilename != null) {
                        File::delete('images/users/'.$oldFilename);
                    }
                    //update
                    $data['avatar'] = $new_name;
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
