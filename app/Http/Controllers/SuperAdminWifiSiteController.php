<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AccessProvider;
use App\Models\Area;
use App\Models\WifiSite;
use Illuminate\Http\Request;

class SuperAdminWifiSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wifi_sites = WifiSite::latest()->get();
        $areas = Area::all();
        return view('superadmin.wifi_site.index', compact(['wifi_sites', 'areas']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::all();
        return view('superadmin.wifi_site.create', compact('areas'));
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
            'site_name' => 'required',
            'equipment' => 'required',
            'macaddress' => 'required',
            'area_id' => 'required'
        ]);

        WifiSite::create($request->all());

        return redirect()->route('superadmin_wifi_sites.index')->with('message', 'Wifi Site Created Successfully');
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
        $wifi_site = WifiSite::Find($id);
        $areas = Area::all();
        return view('superadmin.wifi_site.edit', compact(['wifi_site', 'areas']));
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
            'site_name' => 'required',
            'equipment' => 'required',
            'macaddress' => 'required',
            'area_id' => 'required'
        ]);

        $wifi_site = WifiSite::Find($id);
        $wifi_site->update($request->all());
        return redirect()->route('superadmin_wifi_sites.index')->with('message', 'Wifi Site Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wifi_site = WifiSite::find($id);
        if (Area::find($wifi_site->area_id)->count() > 0 || AccessProvider::where('wifi_site_id', $wifi_site->id)->count() > 0){
            return redirect()->route('superadmin_wifi_sites.index')->with('message', 'Unable to delete. This record has been used by other table');
        }else{
            $wifi_site->delete();
            return redirect()->route('superadmin_wifi_sites.index')->with('message', 'Wifi Site Deleted Successfully');
        }
    }
}
