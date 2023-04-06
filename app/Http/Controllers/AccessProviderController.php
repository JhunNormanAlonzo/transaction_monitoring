<?php

namespace App\Http\Controllers;

use App\Models\AccessProvider;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;


class AccessProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $longlat = '18.3406557,121.6133845';
//        $ip = $request->ip();
//        $ip = '112.206.34.196';

//        $locationInfo = Location::get($ip);
//        dd($locationInfo);

            $providers = AccessProvider::where([
                ['account_name', '!=', null],
                [function($query) use ($request){
                    if (($s = $request->s)){
                        $query->orWhere('account_name', 'like', '%'.$s.'%')
                            ->orWhere('account_address', 'like', '%'.$s.'%')
                            ->get();
                    }
                }]
            ])->paginate(10);

//        $providers = AccessProvider::latest()->paginate(10);

        return view('admin.provider.index', compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.provider.create');
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
            'account_name' => 'required',
            'account_address' => 'required',
            'phone_number' => 'required',
            'provider_type' => 'required',
            'date_started' => 'required',
            'area_id' => 'required',
            'user_id' => 'required'
        ]);

//        AccessProvider::create($request->all());

        return redirect()->back()->with('message', 'Access Provier Created Successfully');
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
       $access_provider = AccessProvider::find($id);
       $access_provider->delete();
        return redirect()->route('access_providers.index')->with('message', 'Access Provier Deleted Successfully');

    }
}
