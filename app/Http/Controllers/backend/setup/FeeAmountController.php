<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategory;
use App\Models\StudentClass;
use App\Models\FeeCategoryAmount;

class FeeAmountController extends Controller
{
    public function FeeAmountView(){
        //$data['allData'] = FeeCategoryAmount::all();
        $data['allData'] = FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.setup.fee_amount.view_amount', $data);
    }

    public function FeeAmountAdd(){
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view("backend.setup.fee_amount.add_amount", $data);
    }

    public function FeeAmountStore(Request $request){
        $countClass = count($request->class_id);
        if($countClass != NULL){
            for ($i=0; $i<$countClass; $i++){
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id= $request->category_id;
                $fee_amount->class_id= $request->class_id[$i];
                $fee_amount->amount= $request->amount[$i];
                $fee_amount->save();
            }
        }

        return redirect()->route('fee.amount.view')->with('message','Fee Category amount added Successfully');

    }


    public function FeeAmountEdit($fee_category_id){
        $data['editData'] = FeeCategoryAmount::where('fee_category_id', $fee_category_id)->orderBy('class_id','asc')->get();
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.edit_amount', $data);
    }

    public function FeeAmountUpdate(Request $request, $fee_category_id){
        if($request->class_id ==NULL ){
            return redirect()->route('fee.amount.view')->with('error','You did not select class and amount');
        }else{
            $countClass = count($request->class_id);
            FeeCategoryAmount::where('fee_category_id', $fee_category_id)->delete();
            for ($i=0; $i<$countClass; $i++){
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id= $request->category_id;
                $fee_amount->class_id= $request->class_id[$i];
                $fee_amount->amount= $request->amount[$i];
                $fee_amount->save();
            }
            return redirect()->route('fee.amount.view')->with('info','data updated successfully');

        }
    }

    public function FeeAmountDetails($fee_category_id){
        $data['editData'] = FeeCategoryAmount::where('fee_category_id', $fee_category_id)->orderBy('class_id','asc')->get();

        return view('backend.setup.fee_amount.details_amount', $data);
    }
}
