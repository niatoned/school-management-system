<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function UserView(){
        $data['allData'] = User::all();
        return view("backend.user.view-user", $data);
    }

    public funtion UserAdd(){
        return view("backend.user.add-user");
    }
}
