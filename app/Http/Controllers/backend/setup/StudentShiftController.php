<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentShift;

class StudentShiftController extends Controller
{
    public function ShiftView(){
        $data['allData'] = StudentShift::all();
        return view('backend.setup.student_shift.view_shift', $data);
    }

    public function ShiftAdd(){
        return view("backend.setup.student_shift.add_shift");
    }

    public function shiftStore(Request $request){
    $validateData = $request->validate([
        'name' => 'required|unique:student_shifts,name'
    ]);
        $data = new StudentShift();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('student.shift.view')->with('message','Student shift added Successfully');
    }


    public function ShiftEdit($id){
        $editData = StudentShift::find($id);

        return view('backend.setup.student_shift.edit_class', compact('editData'));
    }

    public function shiftUpdate(Request $request, $id){
     $data = StudentShift::find($id);
    $validateData = $request->validate([
        'name' => 'required|unique:student_shifts,name,'.$data->id
    ]);

        $data->name = $request->name;
        $data->save();

        return redirect()->route('student.shift.view')->with('message','Student shift updated Successfully');
    }

    public function ShiftDelete($id){
        $data = StudentShift::find($id);
        $data->delete();

        return redirect()->route('student.shift.view')->with('info','Student shift deleted Successfully');
    }
}
