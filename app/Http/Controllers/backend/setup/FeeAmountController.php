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
        $data['allData'] = FeeCategoryAmount::all();
        return view('backend.setup.fee_amount.view_amount', $data);
    }

    public function FeeAmountAdd(Request $request){
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view("backend.setup.fee_amount.add_amount", $data);
    }
}
