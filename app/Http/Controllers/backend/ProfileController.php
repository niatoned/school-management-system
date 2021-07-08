<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

     public function ProfileStore(Request $request){
        $id = Auth::User()->id;
        $data = User::find($id);

        $data->usertype = $request->usertype;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->gender = $request->gender;

        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/user_images/'.$data->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $data['image'] = $filename;
        }

        $data->save();

        return redirect()->route('profile.view')->with('message','User Profile updated Successfully');
    }

    public function PasswordView(){
        return view('backend.profile.edit-password');
    }

    public function PasswordUpdate(Request $request){
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed'
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword, $hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('message','User Password updated Successfully');

        }else{
            return redirect()->back();
        }

    }
}
