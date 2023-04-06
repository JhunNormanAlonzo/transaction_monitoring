<?php

namespace App\Http\Controllers;


use App\Models\AccessProvider;
use App\Models\ProviderType;
use Database\Seeders\ProviderTypeSeeder;
use Illuminate\Http\Request;

class SuperAdminProviderTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provider_types = ProviderType::latest()->get();
        return view('superadmin.provider_type.index', compact('provider_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.provider_type.create');
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
            'type_description' => 'required',
            'discount_rate' => 'required'
        ]);

        ProviderType::create($request->all());

        return redirect()->route('superadmin_provider_types.index')->with('message', 'Provider types Created Successfully!');
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
        $provider_type = ProviderType::find($id);
        return view('superadmin.provider_type.edit', compact('provider_type'));
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
            'type_description' => 'required|unique:provider_types,type_description,'.$id,
            'discount_rate' => 'required|numeric'
        ]);

        $provider_type = ProviderType::find($id);

        $provider_type->update($request->all());

        return redirect()->route('superadmin_provider_types.index')->with('message', 'Provider types Updated Successfully!');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider_type = ProviderType::find($id);
        $access_provider = AccessProvider::where('provider_type', $provider_type->id);

        if ($access_provider->count() > 0){
            return redirect()->route('superadmin_provider_types.index')->with('message', 'Unable to delete. This record has been used by other table!');
        }else{
            $provider_type->delete();
            return redirect()->route('superadmin_provider_types.index')->with('message', 'Provider Type Deleted Successfully!');
        }
    }
}
