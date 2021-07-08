<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function ProfileView(){
        $id = Auth::User()->id;
        $user = User::find($id);

        return view('backend.profile.view-profile', compact('user'));
    }

    public function ProfileEdit(){
        $id = Auth::User()->id;
        $editData = User::find($id);

        return view('backend.profile.edit-profile', compact('editData'));
    }
}
