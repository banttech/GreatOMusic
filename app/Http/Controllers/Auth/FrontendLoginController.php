<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserInformation;
use App\Models\State;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Mail\ForgotMail;
use App\Models\ContactUs;

class FrontendLoginController extends Controller
{
    public function register(Request $request)
    {

        if ($request->method() == 'GET') {

            $states = State::all();
            // dd(count($states));
            $countries = Country::all();
            return view('frontend.auth.register', compact('states', 'countries'));
        }
        if ($request->method() == 'POST') {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:user,email',
                'phone' => 'required',
                'company' => 'required',
                'position' => 'required',
                'city' => 'required',
                'state' => 'required',
                'country' => 'required',
                'website' => 'required',
                'here_about_us' => 'required',
                'terms_conditions' => 'required',
                'password' => 'required',
            ], [
                'name.required' => 'Name field is required',
                'email.required' => 'Email field is required',
                'email.email' => 'Email is invalid',
                'phone.required' => 'Phone Number field is required',
                'company.required' => 'Company Name field is required',
                'position.required' => 'Position field is required',
                'city.required' => 'City field is required',
                'state.required' => 'State field is required',
                'country.required' => 'Country field is required',
                'website.required' => 'Website field is required',
                'here_about_us.required' => 'How did you hear about us? is required',
                'terms_conditions.required' => 'Terms and Condition is required',
                'password.required' => 'Password field is required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->company = $request->company;
            $user->position = $request->position;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->country = $request->country;
            $user->website = $request->website;
            $user->role = 'user';
            $user->twitter = '';
            $user->facebook = '';
            $user->youtube = '';
            $user->referred_by = $request->here_about_us;
            $user->joinEmailList = $request->joinEmailList ? 1 : 0;
            $user->forgot = 0;
            $user->date = date('Y-m-d H:i:s');
            $user->save();

            $data = [
                'name' => $user->name,
                'email' => $user->email,
                'subject' => 'Great "O" Music | Account Setup',
            ];
            // send welcome email to user
            // Mail::send(new WelcomeMail($data));

            $send_mail = ContactUs::first()->send_mail;
            Mail::send(new WelcomeMail($data),[$send_mail], function ($m) {
                $m->from($send_mail, 'Great "O" Music');
            });

            if ($user) {
                return redirect()->route('frontend.login')->with('success', 'Congratulations. Your account has been created successfully and is ready to use.');
            } else {
                return redirect()->back()->with('error', 'Something went wrong please try again');
            }
        }
        return response()->view('frontend.auth.register', [], Response::HTTP_OK);
    }
    public function login(Request $request)
    {
        if ($request->method() == 'POST') {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ], [
                'email.required' => 'Email is required',
                'email.email' => 'Email is invalid',
                'password.required' => 'Password is required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                if (Auth::user()->role == 'user') {
                    // check if request has file and cart_item then redirect to license page
        
                    if (isset($request->file) && $request->file != "") {
                        return redirect()->route('frontend.cart.add', ['id'=>$request->id,'file' => $request->file, 'cart_item' => $request->cart_item]);
                    }
                    // check if forgot is 1 then redirect to change password page
                    if (Auth::user()->forgot == 1) {
                        return redirect()->route('frontend.update.password');
                    } else {
                        return redirect()->route('index');
                    }
                } else {
                    Auth::logout();
                    return redirect()->back()->with('error', 'The account login details you have entered are incorrect. Please try again!');
                }
            } else {
                return redirect()->back()->with('error', 'The account login details you have entered are incorrect. Please try again!');
            }
        }
        return view('frontend.auth.login');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('frontend.login');
    }

    public function forgot(Request $request)
    {
        if ($request->method() == 'POST') {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ], [
                'email.required' => 'Email is required',
                'email.email' => 'Email is invalid',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $user = User::where('email', $request->email)->first();
            if ($user) {
                // send random password to user of 8 characters
                $random_password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
                $user->password = Hash::make($random_password);
                $user->forgot = 1;

                $data = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'subject' => 'Great "O" Music | Password Recovery',
                    'password' => $random_password,
                ];
                // send welcome email to user
                // Mail::send(new ForgotMail($data));

                $send_mail = ContactUs::first()->send_mail;
                Mail::send(new ForgotMail($data),[$send_mail], function ($m) {
                    $m->from($send_mail, 'Great "O" Music');
                });

                $user->save();

                return redirect()->route('frontend.login')->with('success', 'Your temporary password has been sent to your email address.');
            } else {
                return redirect()->back()->with('error', 'Sorry, your email address is not in our system!');
            }
        }

        $pageTitle = "Great “O” Music - Forgot Password";
        return view('frontend.forgot', compact('pageTitle'));
    }

    public function updatePassword(Request $request)
    {
        // check if forgot is 1 then allow to update password
        if (Auth::user()->forgot == 1) {
            if ($request->method() == 'POST') {
                $validator = Validator::make($request->all(), [
                    'password' => 'required',
                    'confirm_password' => 'required|same:password',
                ], [
                    'password.required' => 'New Password is required.',
                    'confirm_password.required' => 'Confirm Password is required.',
                    'confirm_password.same' => 'New Password and Confirm Password must be same.',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }

                $user = User::where('email', Auth::user()->email)->first();
                if ($user) {
                    $user->password = Hash::make($request->password);
                    $user->forgot = 0;
                    $user->save();

                    return redirect()->route('index')->with('success-toast', 'Your password has been updated successfully.');
                } else {
                    return redirect()->back()->with('error', 'Sorry, your email address is not in our system!');
                }
            }
            $pageTitle = "Great “O” Music - Update Password";
            return view('frontend.update-password', compact('pageTitle'));
        } else {
            return redirect()->route('index');
        }
    }
}
