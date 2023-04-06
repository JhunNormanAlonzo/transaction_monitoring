<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuperAdminUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uploads = Upload::latest()->paginate(6);
        return view('upload.index', compact('uploads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('upload.create');
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
            'file_name' => 'required',
            'file_name.*' => 'image|max:204800'
        ]);

        $files = $request->file('file_name');

        if ($request->hasFile('file_name')){
            foreach ($files as $file){
                $tmp_file = $file->hashName();
                $file->move(storage_path('app/public/login'), $tmp_file);
                Upload::create([
                    'file_name' => $tmp_file
                ]);
            }
        }



        return redirect()->route('superadmin_uploads.index')->with('message', 'File Uploaded Successfully!');
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
        $upload = Upload::find($id);

        return view('upload.edit', compact('upload'));
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
            'file_name' => 'required'
        ]);

        $upload = Upload::find($id);

        if ($request->file_name){
            $old = $request->old_file_name;


            if (Storage::exists('/public/login/'.$old)){
                Storage::delete('/public/login/'.$old);
            }else{
                return redirect()->back()->with('message', 'File does not exists!');
            }
            $file = $request->file_name->hashName();
            $request->file_name->move(storage_path('app/public/login'), $file);

        }

        $upload->file_name = $file;
        $upload->save();

        return redirect()->route('superadmin_uploads.index')->with('message', 'File Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $upload = Upload::find($id);
        $upload->delete();
        return redirect()->route('superadmin_uploads.index')->with('message', 'File Deleted Successfully!');
    }
}
