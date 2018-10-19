<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $roles = Role::all();
        // $roles::prepend()
        $roles = Role::pluck('name', 'id'); //value va key
        // dd($roles);
        $roleList = Role::all();

        $permissions = array();

        foreach($roleList as  $role) {
            // dd($role->permissions['post.create']); //tra ve true
            // dd($role->permissions['post.update1'] ?? false); //tra ve false
            foreach($role->permissions as  $key => $permission){

                // dd($key); //post->create
                array_push($permissions, $key);
            }
            // dd($role->permissions);
         // dd(json_decode( $role->permissions, true ));
        }
            // dd($data);
        //loai bo gia tri giong nhau
        // dd(array_unique($permissions));
        $permissions = array_unique($permissions);
        return view('admin.roles.index')->withRoles($roles)->withPermissions($permissions);
    }

    public function getPermissions(Request $request) {
        $role_id = $request->get('role_id'); //null or int
        $role = Role::find($role_id);

        $permissions = array();

        foreach($role->permissions as $key => $permission) {
            array_push($permissions, $key);
        }
        return response()->json([
            'data' => $permissions,
            // 'message' => $request->get('role_id'),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
