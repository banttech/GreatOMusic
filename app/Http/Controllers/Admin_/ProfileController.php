<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Login;
use Auth;
use Hash;

class ProfileController extends Controller
{
    public function index(){
        $pageTitle = "Profile";
        $user = Login::first();
        return view('admin.profile.index', compact('pageTitle', 'user'));
    }

    public function update(Request $request){
        $login = Login::first();
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'nullable|min:8',
        ],[
            'name.required' => 'Name field is required!',
            'username.required' => 'Username field is required!',
            'password.min' => 'Password must be at least 8 characters!',
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('admin-assets/images'), $imageName);
            $login->image = $imageName;
        }

        $login->name = $request->name;
        $login->username = $request->username;
        $login->password = ($request->password != null) ? Hash::make($request->password) : $login->password;
        $login->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}