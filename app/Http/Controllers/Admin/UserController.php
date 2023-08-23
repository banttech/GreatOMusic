<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'asc')->get();
        $pageTitle = 'Manage Users';
        return view('admin.users.index', compact('users', 'pageTitle'));
    }

    // edit, update, delete
    public function edit($id)
    {
        $pageTitle = 'Edit User';
        $user = User::find($id);
        return view('admin.users.edit', compact('pageTitle', 'user'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email'=> 'required|email',
            'phone'=> 'required',
            'company'=> 'required',
            'position'=> 'required',
            'city'=> 'required',
            'state'=> 'required',
            'country'=> 'required',
            'website'=> 'required',
            'referred_by'=> 'required',
            'joinEmailList'=> 'required',
        ], [
            'name.required' => 'Name field is required!',
            'email.required' => 'Email field is required!',
            'phone.required' => 'Phone field is required!',
            'company.required' => 'Company field is required!',
            'position.required' => 'Position field is required!',
            'city.required' => 'City field is required!',
            'state.required' => 'State field is required!',
            'country.required' => 'Country field is required!',
            'website.required' => 'Website field is required!',
            'referred_by.required' => 'Referred By field is required!',
            'joinEmailList.required' => 'Join Email List field is required!',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->company = $request->company;
        $user->position = $request->position;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->website = $request->website;
        $user->referred_by = $request->referred_by;
        $user->joinEmailList = $request->joinEmailList;
        $user->save();

        return redirect()->route('users')->with('success', 'User updated successfully');
    }

    public function delete($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }
}