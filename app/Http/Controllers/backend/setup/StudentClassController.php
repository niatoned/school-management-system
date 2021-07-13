<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;


class StudentClassController extends Controller
{
    public function StudentView(){
        $data['allData'] = StudentClass::all();
        return view('backend.setup.student_class.view_class', $data);
    }

    public function StudentAdd(){
        return view("backend.setup.student_class.add_class");
    }

    public function StudentStore(Request $request){
    $validateData = $request->validate([
        'name' => 'required|unique:student_classes,name'
    ]);
        $data = new StudentClass();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('student.class.view')->with('message','Student Class added Successfully');
    }


    public function StudentEdit($id){
        $editData = StudentClass::find($id);

        return view('backend.setup.student_class.edit_class', compact('editData'));
    }

    public function StudentUpdate(Request $request, $id){
     $data = StudentClass::find($id);
    $validateData = $request->validate([
        'name' => 'required|unique:student_classes,name,'.$data->id
    ]);

        $data->name = $request->name;
        $data->save();

        return redirect()->route('student.class.view')->with('message','Student Class updated Successfully');
    }

    public function StudentDelete($id){
        $data = StudentClass::find($id);
        $data->delete();

        return redirect()->route('student.class.view')->with('info','Student Class deleted Successfully');
    }
}
