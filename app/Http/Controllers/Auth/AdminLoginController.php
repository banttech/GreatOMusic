<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Login;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('dashboard');
        }

        if ($request->method() == 'POST') {
            $validator = Validator::make($request->all(), [
                'username' => 'required|email',
                'password' => 'required',
            ], [
                'username.required' => 'Email is required',
                'username.email' => 'Email is invalid',
                'password.required' => 'Password is required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $credentials = $request->only('username', 'password');

            // attempt auth attempt on Login model
            if (Auth::guard('admin')->attempt($credentials)) {
                // if successful then redirect to the intended location
                return redirect()->route('dashboard');
            } else {
                // if unsuccessful then redirect back to the login with the form data
                return redirect()->back()->with('error', 'Invalid Credentials');
            }
        }
        return view('admin.login.index');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
