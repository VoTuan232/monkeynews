<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Input; 
use Validator;
use Auth;
use App\Repositories\UserRepository;
use File;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function index() {
        $users = User::paginate(2);
        return new UserCollection($users);
        // return  UserResource::collection($users);
    }

    public function show (User $user)
    {
        UserResource::withoutWrapping();
        return new UserResource($user);
    }

    public function store(Request $request) {
      $user = $request->isMethod('put') ? User::findOrFail($request->user_id) : new User;

      $user->id = $request->input('user_id');
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->password = Hash::make($request->input('password'));
       
        
      if($user->save()) {
        return new UserResource($user);
      }
    }

    public function destroy($id) {
      $user = User::findOrFail($id);

      if($user->delete()) {
        return new UserResource($user);
      }
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
