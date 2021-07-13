<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentGroup;

class StudentGroupController extends Controller
{
    public function GroupView(){
        $data['allData'] = StudentGroup::all();
        return view('backend.setup.student_group.view_group', $data);
    }

    public function GroupAdd(){
        return view("backend.setup.student_group.add_group");
    }

    public function GroupStore(Request $request){
    $validateData = $request->validate([
        'name' => 'required|unique:student_groups,name'
    ]);
        $data = new StudentGroup();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('student.group.view')->with('message','Student Group added Successfully');
    }


    public function GroupEdit($id){
        $editData = StudentGroup::find($id);

        return view('backend.setup.student_group.edit_class', compact('editData'));
    }

    public function GroupUpdate(Request $request, $id){
     $data = StudentGroup::find($id);
    $validateData = $request->validate([
        'name' => 'required|unique:student_groups,name,'.$data->id
    ]);

        $data->name = $request->name;
        $data->save();

        return redirect()->route('student.group.view')->with('message','Student Group updated Successfully');
    }

    public function GroupDelete($id){
        $data = StudentGroup::find($id);
        $data->delete();

        return redirect()->route('student.group.view')->with('info','Student Group deleted Successfully');
    }
}
