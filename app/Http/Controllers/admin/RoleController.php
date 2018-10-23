<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Input;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $roles = Role::pluck('name', 'id'); //value va key
        $roleList = Role::all();

        $permissions = array();

        foreach($roleList as  $role) {
         
            foreach($role->permissions as  $key => $permission){

                array_push($permissions, $key);
            }
          
        }
    
        $permissions = array_unique($permissions);
        return view('admin.roles.index')->withRoles($roles)->withPermissions($permissions);
    }

    public function getPermissions(Request $request) {
        $role_id = $request->get('role_id');
        $role = Role::find($role_id);

        $permissions = array();

        foreach($role->permissions as $key => $permission) {
            array_push($permissions, $key);
        }
        return response()->json([
            'data' => $permissions,
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
    public function update(Request $request)
    {
        $role = Role::find($request->role_id);

        $permissions = $request->pers;

        $array = array();
        if(!is_null($permissions)){
            foreach($permissions as $permission) {
                $array[$permission] = true;
            }
        }
        $role->permissions = $array;
        
        $role->save();

        return response()->json([
            'message' => 'Updated successfully',
            'class_name' => 'alert-success',
        ]);
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
