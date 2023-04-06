<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::where([
            ['name', '!=', null],
            [function($query) use ($request){
                if ($s = $request->s){
                    $query->orWhere('name', 'like', '%'.$s.'%')
                        ->orWhere('phone_number', 'like', '%'.$s.'%')
                        ->orWhere('municipality', 'like', '%'.$s.'%')
                        ->orWhere('province', 'like', '%'.$s.'%')
                        ->get();
                }
            }]
        ])->paginate(10);



        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        return view('admin.user.create');
        $roles = Role::all();

        return view('admin.user.create', compact('roles'));
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
        $role = Role::where('name', 'access provider')->first();

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
        $roles = Role::all();
        $user = User::find($id);

        return view('admin.user.edit', compact(['user', 'roles']));
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
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::find($id);

        $data = [
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'name' => ucwords($request->firstname.' '.$request->middlename.' '.$request->lastname),
            'email' => $request->email,
            'password' => empty($request->password) ? $user->password : bcrypt($request->password)
        ];
        $user->update($data);

        return redirect()->back()->with('message', 'User Update Successfully');
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
        $user->delete();

        return redirect()->route('users.index');
    }




}
