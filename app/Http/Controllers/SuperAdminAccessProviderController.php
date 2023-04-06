<?php

namespace App\Http\Controllers;

use App\Models\AccessProvider;
use App\Models\Area;
use App\Models\Role;
use App\Models\User;
use App\Models\WalletTransaction;
use App\Models\WifiSite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class SuperAdminAccessProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = AccessProvider::latest()->get();
        return view('superadmin.access_provider.index', compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wifi_sites = WifiSite::all();
        return view('superadmin.access_provider.create', compact('wifi_sites'));
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
            'password' => 'required|min:8|confirmed',
            'account_name' => 'required',
            'account_address' => 'required',
            'phone_number' => 'required',
            'provider_type' => 'required',
            'date_started' => 'required',
            'wifi_site_id' => 'required',
        ]);

        $wifi_site = WifiSite::find($request->wifi_site_id);


        $role = Role::where('name', 'access provider')->first();

        $role_id = $role->id;

        $user = [
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'name' => ucwords($request->firstname.' '.$request->middlename.' '.$request->lastname),
            'email' => $request->email,
            'role_id' => $role_id,
            'password' => bcrypt($request->password)
        ];

        $user_data = User::create($user);

        Password::sendResetLink($request->only('email'));

        $access_provider = [
            'account_name' => $request->account_name,
            'account_address' => $request->account_address,
            'phone_number' => $request->phone_number,
            'provider_type' => $request->provider_type,
            'date_started' => $request->date_started,
            'map_location' => $request->map_location,
            'wifi_site_id' => $request->wifi_site_id,
            'area_id' => $wifi_site->area_id,
            'user_id' => $user_data->id
        ];


        AccessProvider::create($access_provider);

        $access_providers = AccessProvider::latest()->get();

        return redirect()->route('superadmin_access_providers.index', compact('access_providers'))->with('message', 'User Created Successfully');

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
        $access_provider = AccessProvider::find($id);
        $user_id = $access_provider->user_id;
        $user = User::find($user_id);
        $wifi_sites = WifiSite::all();
        return view('superadmin.access_provider.edit', compact(['user', 'access_provider', 'wifi_sites']));
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

        $access_provider_data = AccessProvider::find($id);

        $user_data = User::find($access_provider_data->user_id);

        $this->validate($request, [
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email,'.$user_data->id,
            'account_name' => 'required',
            'account_address' => 'required',
            'phone_number' => 'required',
            'provider_type' => 'required',
            'date_started' => 'required'
        ]);

        $wifi_site = WifiSite::find($request->wifi_site_id);

        if (!empty($request->password)){
            $password = bcrypt($request->password);
        }else{
            $password = $user_data->password;
        }

        $user = [
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'name' => ucwords($request->firstname.' '.$request->middlename.' '.$request->lastname),
            'email' => $request->email,
            'password' => $password
        ];

        $user_data->update($user);

        $access_provider = [
            'account_name' => $request->account_name,
            'account_address' => $request->account_address,
            'phone_number' => $request->phone_number,
            'provider_type' => $request->provider_type,
            'date_started' => $request->date_started,
            'map_location' => $request->map_location,
            'wifi_site_id' => $request->wifi_site_id,
            'area_id' => $wifi_site->area_id,
        ];


        $access_provider_data->update($access_provider);


        return redirect()->route('superadmin_access_providers.index')->with('message', 'User Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $access_provider = AccessProvider::find($id);
        $user_id = $access_provider->user_id;
        $user = User::find($user_id);

        if (WalletTransaction::where('user_id', $user->id)->count() > 0){
            return redirect()->route('superadmin_access_providers.index')->with('message', 'Unable to delete. This record has been used by other table');
        }else{
            $access_provider->delete();
            $user->delete();
            return redirect()->route('superadmin_access_providers.index')->with('message', 'User Deleted Successfully');
        }
    }

//    public function checkTriangle($n){
//        $temp = 0;
//        $res = false;
//        for ($x=1; $x<=$n; $x++){
//            $temp = $temp+$x;
//            if ($temp == $n){
//                $res = true;
//                break;
//            }else{
//                $res = false;
//            }
//        }
//
//        return $res;
//    }
}
