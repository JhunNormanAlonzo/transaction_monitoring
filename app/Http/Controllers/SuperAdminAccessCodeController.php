<?php

namespace App\Http\Controllers;

use App\Imports\AccessCodesImport;
use App\Models\AccessCode;
use App\Models\ImportLog;
use App\Models\WifiSite;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SuperAdminAccessCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wifi_sites = WifiSite::all();
        return view('superadmin.access_code.index', compact('wifi_sites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'csv' => 'required|mimes:csv',
            'wifi_site_id' => 'required'
        ]);

        $import = new AccessCodesImport;

       Excel::import($import, $request->csv);

        $data = [
            'wifi_site_id' => $request->wifi_site_id,
            'batch' => Carbon::parse(now())->format('Y-m-d'),
            'user_id' => auth()->user()->id
        ];

        $wifi_site = WifiSite::find($request->wifi_site_id);

        $import_log = ImportLog::create($data);

        $access_codes = AccessCode::where('import_log_id', null);
        $toUp = ['import_log_id' => $import_log->id];
        $access_codes->update($toUp);

        return redirect()->back()->with('message', $wifi_site->site_name.' batch '.$data['batch'].' Uploaded Successfully.');
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
        //
    }

    public function onlyLoaded(){

        $access_codes = AccessCode::whereNotNull('loaded_at')->get();

        return view('superadmin.access_code.send_load', compact('access_codes'));
    }

    public function uploadAccessCode(Request $request){


    }



    public function import_logs(){
        $import_logs = ImportLog::all();
        return view('superadmin.access_code.import_log', compact('import_logs'));
    }
}
