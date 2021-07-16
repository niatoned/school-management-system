<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
use App\Models\AssignSubject;

class AssignSubjectController extends Controller
{
    public function AssignSubjectView(){
        //$data['allData'] = FeeCategoryAmount::all();
        $data['allData'] = AssignSubject::select('class_id')->groupBy('class_id')->get();
        return view('backend.setup.assign_subject.view_assign', $data);
    }

    public function AssignSubjectAdd(){
        $data['subjects'] = SchoolSubject::all();
        $data['classes'] = StudentClass::all();
        return view("backend.setup.assign_subject.add_assign", $data);
    }

    public function AssignSubjectStore(Request $request){
        $counSubject = count($request->subject_id);
        if($counSubject != NULL){
            for ($i=0; $i<$counSubject; $i++){
                $assign_subject = new AssignSubject();
                $assign_subject->class_id= $request->class_id;
                $assign_subject->subject_id= $request->subject_id[$i];
                $assign_subject->full_mark= $request->full_mark[$i];
                $assign_subject->pass_mark= $request->pass_mark[$i];
                $assign_subject->subjective_mark= $request->subjective_mark[$i];
                $assign_subject->save();
            }
        }

        return redirect()->route('assign.subject.view')->with('message','data added Successfully');

    }


    public function AssignSubjectEdit($class_id){
        $data['editData'] = AssignSubject::where('class_id', $class_id)->orderBy('class_id','asc')->get();
        $data['subjects'] = SchoolSubject::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.assign_subject.edit_assign', $data);
    }

    public function AssignSubjectUpdate(Request $request, $class_id){
        if($request->subject_id ==NULL ){
            return redirect()->route('assign.subject.view')->with('error','You did not add item');
        }else{
            $countSubject = count($request->subject_id);
            AssignSubject::where('class_id', $class_id)->delete();
            for ($i=0; $i<$countSubject; $i++){
                $assign_subject = new AssignSubject();
                $assign_subject->class_id= $request->class_id;
                $assign_subject->subject_id= $request->subject_id[$i];
                $assign_subject->full_mark= $request->full_mark[$i];
                $assign_subject->pass_mark= $request->pass_mark[$i];
                $assign_subject->subjective_mark= $request->subjective_mark[$i];
                $assign_subject->save();
            }
            return redirect()->route('assign.subject.view')->with('info','data updated successfully');

        }
    }

    public function AssignSubjectDetails($id){
        $data['editData'] = AssignSubject::where('class_id', $id)->orderBy('class_id','asc')->get();

        return view('backend.setup.assign_subject.details_assign', $data);
    }
}
