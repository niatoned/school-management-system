<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentYear;

class StudentYearController extends Controller
{
    public function YearView(){
        $data['allData'] = StudentYear::all();
        return view('backend.setup.student_year.view_year', $data);
    }

    public function YearAdd(){
        return view("backend.setup.student_year.add_year");
    }

    public function YearStore(Request $request){
    $validateData = $request->validate([
        'name' => 'required|unique:student_years,name'
    ]);

        $data = new StudentYear();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('student.year.view')->with('message','Student Year added Successfully');
    }

    public function YearEdit($id){
        $editData = StudentYear::find($id);

        return view('backend.setup.student_year.edit_year', compact('editData'));
    }

    public function YearUpdate(Request $request, $id){
     $data = StudentYear::find($id);
     $validateData = $request->validate([
        'name' => 'required|unique:student_years,name,'.$data->id
    ]);

        $data->name = $request->name;
        $data->save();

        return redirect()->route('student.year.view')->with('message','Student Year updated Successfully');
    }

    public function YearDelete($id){
        $data = StudentYear::find($id);
        $data->delete();

        return redirect()->route('student.year.view')->with('info','Student Year deleted Successfully');
    }
}
