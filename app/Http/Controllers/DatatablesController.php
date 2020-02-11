<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Model\Employee;
use Log,Storage,File;
class DatatablesController extends Controller
{
    
    public function index()

    {
        $employee = Employee::select(['id','name','salary','created_at','updated_at']);
        return Datatables::of($employee)->make(true);

            }

    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {

        $name       = $request->get('name');
        $birthdate   = $request->get('birthdate');
        $gender     = $request->get('gender');
        $file       = $request->file('file');
        if ($request->hasFile('file')) {
             $original_name = $file->getClientOriginalExtension();
            $filename       = time().".".$original_name;
            Storage::disk('public')->put($filename,File::get($file));
            if(Storage::disk('public')->exists($filename)) {  // check file exists in directory or not
               dd("file is store successfully : ".$filename);            
            }else { 
               dd("file is not found :- ".$filename);
            }

        }else{
            dd('No image ');
        }
        $form_data = [
                'name' => $name,
                'birthdate' => $birthdate,
                'gender' => $gender,
                'image'     =>'public/'.$filename,
        ];
          Employee::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
    }

   
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
        $employee = Employee::findorFail($id);
        
        if($employee){
             $employee->delete();
        } else{
            return response()->json(error);
        }
        return response()->json('deleted');

    }
}
