<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamType;

class ExamTypeController extends Controller
{
     public function ExamTypeView(){
        $data['allData'] = ExamType::all();
        return view('backend.setup.exam_type.view_exam_type', $data);
    }

    public function ExamTypeAdd(){
        return view("backend.setup.exam_type.add_exam_type");
    }

    public function ExamTypeStore(Request $request){
    $validateData = $request->validate([
        'name' => 'required|unique:exam_types,name'
    ]);
        $data = new ExamType();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('exam.type.view')->with('message','Exam Type added Successfully');
    }


    public function ExamTypeEdit($id){
        $editData = ExamType::find($id);

        return view('backend.setup.exam_type.edit_exam_type', compact('editData'));
    }

    public function ExamTypeUpdate(Request $request, $id){
     $data = ExamType::find($id);
    $validateData = $request->validate([
        'name' => 'required|unique:exam_types,name,'.$data->id
    ]);

        $data->name = $request->name;
        $data->save();

        return redirect()->route('exam.type.view')->with('message','Exam type updated Successfully');
    }

    public function ExamTypeDelete($id){
        $data = ExamType::find($id);
        $data->delete();

        return redirect()->route('exam.type.view')->with('info','Exam Type deleted Successfully');
    }
}
