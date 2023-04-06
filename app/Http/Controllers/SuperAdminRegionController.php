<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Region;
use Illuminate\Http\Request;

class SuperAdminRegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::all();
        return view('superadmin.region.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.region.create');
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
           'name' => 'required|unique:regions'
        ]);

        Region::create($request->all());

        return redirect()->route('superadmin_regions.index')->with('message', 'Region Created Successfully!');
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
        $region = Region::find($id);
        return view('superadmin.region.edit', compact('region'));

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
        $region = Region::find($id);
        $this->validate($request, [
            'name' => 'required|unique:regions,name,'.$id
        ]);

        $region->update($request->all());

        return redirect()->route('superadmin_regions.index')->with('message', 'Region Update Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region = Region::find($id);

        if (Area::where('region_id', $region->id)->count() > 0){
            return redirect()->route('superadmin_regions.index')->with('message', 'Unable to delete. This record has been used by other table');
        }else{
            $region->delete();
            return redirect()->route('superadmin_regions.index')->with('message', 'Region Deleted Successfully!');
        }


    }
}
