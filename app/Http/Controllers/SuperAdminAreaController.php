<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AccessProvider;
use App\Models\Area;
use App\Models\Region;
use App\Models\WifiSite;
use Illuminate\Http\Request;

class SuperAdminAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::all();
        return view('superadmin.area.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::all();
        return view('superadmin.area.create', compact('regions'));
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
           'name' => 'required|unique:areas',
           'region_id' => 'required'
        ]);

        Area::create($request->all());

        return redirect()->route('superadmin_areas.index')->with('message', 'Area Created Successfully!');

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
        $area = Area::find($id);
        $regions = Region::all();
        return view('superadmin.area.edit', compact(['area', 'regions']));
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
        $area = Area::find($id);
        $this->validate($request, [
            'name' => 'required|unique:areas,name,'.$id,
            'region_id' => 'required'
        ]);

        $area->update($request->all());
        return redirect()->route('superadmin_areas.index')->with('message', 'Area Updated Successfully!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Area::find($id);



        if (WifiSite::where('area_id', $area->id)->count() > 0 || AccessProvider::where('area_id')->count() > 0){
            return redirect()->route('superadmin_areas.index')->with('message', 'Unable to delete. This record has been used by other table');
        }

        $area->delete();
        return redirect()->route('superadmin_areas.index')->with('message', 'Area Deleted Successfully!');




    }
}
