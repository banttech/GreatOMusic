<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class ProfileController extends Controller
{
    public function index(){
        $pageTitle = "Profile";
        $user = User::find(Auth::user()->id);
        return view('admin.profile.index', compact('pageTitle', 'user'));
    }

    public function update(Request $request){
        $user = User::find(Auth::user()->id);
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
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('admin-assets/images'), $imageName);
            $user->image = $imageName;
        }

        $user->name = $request->name;
        $user->email = $request->username;
        $user->password = ($request->password != null) ? Hash::make($request->password) : $user->password;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}