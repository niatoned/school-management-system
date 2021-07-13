<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategory;

class FeeCategoryController extends Controller
{
    public function FeeCatView(){
        $data['allData'] = FeeCategory::all();
        return view('backend.setup.fee_category.view_cat', $data);
    }

    public function FeeCatAdd(){
        return view("backend.setup.fee_category.add_cat");
    }

    public function FeeCatStore(Request $request){
    $validateData = $request->validate([
        'name' => 'required|unique:fee_categories,name'
    ]);
        $data = new FeeCategory();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('fee.category.view')->with('message','Fee Category added Successfully');
    }


    public function FeeCatEdit($id){
        $editData = FeeCategory::find($id);

        return view('backend.setup.fee_category.edit_cat', compact('editData'));
    }

    public function FeeCatUpdate(Request $request, $id){
     $data = FeeCategory::find($id);
    $validateData = $request->validate([
        'name' => 'required|unique:fee_categories,name,'.$data->id
    ]);

        $data->name = $request->name;
        $data->save();

        return redirect()->route('fee.category.view')->with('message','Fee Category updated Successfully');
    }

    public function FeeCatDelete($id){
        $data = FeeCategory::find($id);
        $data->delete();

        return redirect()->route('fee.category.view')->with('info','Fee Category deleted Successfully');
    }
}
