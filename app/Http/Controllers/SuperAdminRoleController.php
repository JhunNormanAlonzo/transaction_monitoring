<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\WifiSite;
use Illuminate\Http\Request;

class SuperAdminRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('superadmin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles',
            'description' => 'required'
        ]);

        Role::create($request->all());
        return redirect()->route('superadmin_roles.index')->with('message', 'Role Created Successfully!');
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
        $role = Role::find($id);
        return view('superadmin.role.edit', compact('role'));
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
        $this->validate($request, [
            'name' => 'required|unique:roles,name,'.$id,
            'description' => 'required'
        ]);

        $role = Role::find($id);
        $role->update($request->all());
        return redirect()->route('superadmin_roles.index')->with('message', 'Role Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);

        if (User::where('role_id', $role->id)->count() > 0){
            return redirect()->route('superadmin_roles.index')->with('message', 'Unable to delete. This role has been used by other table!');
        }else{
            $role->delete();
            return redirect()->route('superadmin_roles.index')->with('message', 'Role Deleted Successfully!');
        }

    }
}
