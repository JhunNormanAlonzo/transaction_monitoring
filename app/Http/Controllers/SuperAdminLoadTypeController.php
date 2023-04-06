<?php

namespace App\Http\Controllers;

use App\Models\AccessCode;
use App\Models\LoadType;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;

class SuperAdminLoadTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $load_types = LoadType::latest()->get();
        return view('superadmin.load_type.index', compact('load_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.load_type.create');
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
           'load_name' => 'required|unique:load_types',
           'load_credits' => 'required|numeric',
           'comments' => 'required'
        ]);

        LoadType::create($request->all());
        return redirect()->route('superadmin_load_types.index')->with('message', 'Load Type Created Successfully!');
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
        $load_type = LoadType::find($id);
        return view('superadmin.load_type.edit', compact('load_type'));
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
        $load_type = LoadType::find($id);
        $this->validate($request, [
            'load_name' => 'required|unique:load_types,id,'.$id,
            'load_credits' => 'required|numeric',
            'comments' => 'required'
        ]);
        $load_type->update($request->all());
        return redirect()->route('superadmin_load_types.index')->with('message', 'Load Type Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $load_type = LoadType::find($id);

        if (AccessCode::where('load_type_id', $load_type->id)->count() > 0 || WalletTransaction::where('load_type_id', $load_type->id)->count() > 0){
            return redirect()->route('superadmin_load_types.index')->with('message', 'Unable to delete. This record has been used by other table!');
        }else{
            $load_type->delete();
            return redirect()->route('superadmin_load_types.index')->with('message', 'Load Type Deleted Successfully!');
        }
    }
}
