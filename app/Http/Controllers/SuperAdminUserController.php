<?php

namespace App\Http\Controllers;

use App\Models\AccessProvider;
use App\Models\Role;
use App\Models\User;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;

class SuperAdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->get();
        return view('superadmin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('superadmin.user.create', compact('roles'));
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
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);
        $role = Role::where('name', 'admin')->first();

        $role_id = $role->id;

        $data = [
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'name' => ucwords($request->firstname.' '.$request->middlename.' '.$request->lastname),
            'email' => $request->email,
            'role_id' => $role_id,
            'password' => bcrypt($request->password)
        ];
        User::create($data);

        return redirect()->back()->with('message', 'User Created Successfully');
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
        $user = User::find($id);
        $roles = Role::all();
        return view('superadmin.user.edit', compact(['user', 'roles']));

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
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'role_id' => 'required',
        ]);

        $user = User::find($id);

        if (!empty($request->password)){
            $password = bcrypt($request->password);
        }else{
            $password = $user->password;
        }

        $data = [
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'name' => ucwords($request->firstname.' '.$request->middlename.' '.$request->lastname),
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => $password
        ];

        $user->update($data);

        return redirect()->route('superadmin_users.index')->with('message', 'User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);


        if ($user->access_providers){
            $access_provider = AccessProvider::where('user_id', $user->id);
            $wallet_transaction = WalletTransaction::where('user_id', $user->id);

            $approves = WalletTransaction::where('approval_user_id', $user->id);

            if ($wallet_transaction->count() > 0 || $approves->count() > 0){
                return redirect()->route('superadmin_users.index')->with('message', 'Unable to delete. This user has been used by other table!');
            }else {
                $access_provider->delete();
                $user->delete();
                return redirect()->route('superadmin_users.index')->with('message', 'User Deleted Successfully!');
            }
        }else{
            $user->delete();
            return redirect()->route('superadmin_users.index')->with('message', 'User Deleted Successfully!');
        }


    }
}
