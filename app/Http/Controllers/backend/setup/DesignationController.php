<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;

class DesignationController extends Controller
{
    public function DesignationView(){
        $data['allData'] = Designation::all();
        return view('backend.setup.designation.view', $data);
    }

    public function DesignationAdd(){
        return view("backend.setup.designation.add");
    }

    public function DesignationStore(Request $request){
    $validateData = $request->validate([
        'name' => 'required|unique:Designations,name'
    ]);
        $data = new Designation();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('designation.view')->with('message','Designation added Successfully');
    }


    public function DesignationEdit($id){
        $editData = Designation::find($id);

        return view('backend.setup.designation.edit', compact('editData'));
    }

    public function DesignationUpdate(Request $request, $id){
     $data = Designation::find($id);
    $validateData = $request->validate([
        'name' => 'required|unique:designations,name,'.$data->id
    ]);

        $data->name = $request->name;
        $data->save();

        return redirect()->route('designation.view')->with('message','Designation updated Successfully');
    }

    public function DesignationDelete($id){
        $data = Designation::find($id);
        $data->delete();

        return redirect()->route('designation.view')->with('info','Designation deleted Successfully');
    }
}
