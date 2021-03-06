<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Role;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers() {

     return DB::table('users')
        ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id' )
        ->leftJoin('roles', 'roles.id', '=', 'role_user.role_id' )
        ->leftJoin('posts', 'users.id', '=', 'posts.user_id' )
        ->selectRaw(' users.id as user_id, users.email, roles.name as role_name, users.name as username, count(posts.id) as post_number')->groupBy('user_id')->get();
    }

    public function index()
    {
        // $users = $this->getUsers();
        $users = User::with('roles', 'posts')->paginate(8);
        
        $roles = Role::pluck('name','id'); 

        return view('admin.users.index')->withUsers($users)->withRoles($roles)->withRoles($roles);
    }

    public function findUser($id) {
        return DB::table('users')
        ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id' )
        ->leftJoin('roles', 'roles.id', '=', 'role_user.role_id' )
        ->leftJoin('posts', 'users.id', '=', 'posts.user_id' )
        ->selectRaw(' users.id as user_id, users.email, roles.name as role_name, users.name as username, count(posts.id) as post_number, roles.id as role_id')->groupBy('user_id')->where('users.id', $id)->first();
    }

    public function store(Request $request)
    {
        $validation = UserRequest::rules($request);

        if($validation->passes()){

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),

            ]);

            if(!is_null($request->role)) {
                $user->roles()->sync($request->role, false);
            }
            return response()->json([
                'message'   => 'Đã tạo user thành công!',
                'class_name'  => 'alert-success',
                'user_data'  => $this->findUser($user->id),
            ]);
        }

        return response()->json([
            'message' => $validation->errors()->all(),
             'class_name'  => 'alert-danger',
        ]);
    }

    public function edit(Request $request)
    {
        $user = User::where('id', $request->id)->with('roles', 'posts')->get();

        return response()->json($user);
        // $user = $this->findUser($request->id);

        // return response()->json([
        //     'user_data' => $user,
        // ]);
    }

    public function update(Request $request)
    {
        $validation = UserRequest::rulesUpdate($request);

        if($validation->passes()) {

            $user = User::where('id', '=', $request->user_id)->first();
            $user->name = $request->name;
            $user->email = $request->email;

           $user->roles()->sync($request->role, true);

            $user->save();

            $user = User::where('id', $user->id)->with('roles', 'posts')->get();

            return response()->json([
                'user_data' => $user,
                'message'   => __('language.update_post_success'),
                'class_name'  => 'alert-success',
            ]);
        }

        return response()->json([
            'message'   =>  $validation->errors()->all(),
            'class_name'  => 'alert-danger',
        ]);
    }

    public function destroy($id)
    {
        //
    }
}
