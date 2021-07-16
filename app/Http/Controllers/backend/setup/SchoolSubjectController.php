<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolSubject;

class SchoolSubjectController extends Controller
{
    public function SchoolSubjectView(){
        $data['allData'] = SchoolSubject::all();
        return view('backend.setup.school_subject.view_subject', $data);
    }

    public function SchoolSubjectAdd(){
        return view("backend.setup.school_subject.add_subject");
    }

    public function SchoolSubjectStore(Request $request){
    $validateData = $request->validate([
        'name' => 'required|unique:school_subjects,name'
    ]);
        $data = new SchoolSubject();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('school.subject.view')->with('message','SchoolSubject added Successfully');
    }


    public function SchoolSubjectEdit($id){
        $editData = SchoolSubject::find($id);

        return view('backend.setup.school_subject.edit_subject', compact('editData'));
    }

    public function SchoolSubjectUpdate(Request $request, $id){
     $data = SchoolSubject::find($id);
    $validateData = $request->validate([
        'name' => 'required|unique:school_subjects,name,'.$data->id
    ]);

        $data->name = $request->name;
        $data->save();

        return redirect()->route('school.subject.view')->with('message','SchoolSubject updated Successfully');
    }

    public function SchoolSubjectDelete($id){
        $data = SchoolSubject::find($id);
        $data->delete();

        return redirect()->route('school.subject.view')->with('info','SchoolSubject deleted Successfully');
    }
}
