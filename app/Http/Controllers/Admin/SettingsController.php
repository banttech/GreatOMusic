<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Social;
use App\Models\ContactUs;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function index()
    {
        $pageTitle = "Settings";
        // $settings = Setting::first();
        $login = Login::first();
        $facebook = Social::where('name', 'facebook')->first()->user_id;
        $twitter = Social::where('name', 'twitter')->first()->user_id;
        $youtube = Social::where('name', 'youtube')->first()->user_id;
        $contactUs = ContactUs::first();
        return view('admin.settings.index', compact('pageTitle', 'login', 'facebook', 'twitter', 'youtube', 'contactUs'));
    }

    public function store(Request $request){
        $login = Login::first();
        $validator = Validator::make($request->all(), [
            'logo' => 'required|image|mimes:jpg,png,jpeg|dimensions:width=200,height=25',
        ],[
            'logo.required' => 'Logo Image field is required!',
            'logo.image' => 'Logo Image must be an image!',
            'logo.mimes' => 'Please upload valid image. Only JPG, JPEG and PNG extensions are allowed.',
            'logo.dimensions' => "Logo Image size can't exceeds the size 200px X 25px",
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if($request->hasFile('logo')) {
            $alreadyExist = public_path('admin-assets/images/'.$login->logo);
            if(file_exists($alreadyExist)) {
                unlink($alreadyExist);
            }

            $image = $request->file('logo');
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('admin-assets/images');
            $image->move($destinationPath, $name);
            $image = $name;
        }else {
            $image = $login->logo;
        }

        if(!$login) {
            $login = new Login;
        }

        $login->username = $request->username ? $request->username : $login->username;
        $login->password = $request->password ? Hash::make($request->password) : $login->password;
        $login->logo = $image;
        $login->save();

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }

    public function updateSocialMedia(Request $request){
        $validator = Validator::make($request->all(), [
            'facebook' => 'required',
            'twitter' => 'required',
            'youtube' => 'required',
        ],[
            'facebook.required' => 'Facebook field is required!',
            'twitter.required' => 'Twitter field is required!',
            'youtube.required' => 'Youtube field is required!',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Social::truncate();

        $social = new Social;
        $social->name = 'facebook';
        $social->user_id = $request->facebook;
        $social->save();

        $social = new Social;
        $social->name = 'twitter';
        $social->user_id = $request->twitter;
        $social->save();

        $social = new Social;
        $social->name = 'youtube';
        $social->user_id = $request->youtube;
        $social->save();

        return redirect()->back()->with('success', 'Social media updated successfully!');
    }

    public function updateMailingAddress(Request $request){
        $validator = Validator::make($request->all(), [
            'send_mail' => 'required|email',
            'receive_mail' => 'required|email',
        ],[
            'send_mail.required' => 'Send mail field is required!',
            'send_mail.email' => 'Send mail must be a valid email!',
            'receive_mail.required' => 'Receive mail field is required!',
            'receive_mail.email' => 'Receive mail must be a valid email!',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $contactUs = ContactUs::first();
        if(!$contactUs) {
            $contactUs = new ContactUs;
        }

        $contactUs->send_mail = $request->send_mail;
        $contactUs->receive_mail = $request->receive_mail;
        $contactUs->save();

        return redirect()->back()->with('success', 'Mailing address updated successfully!');
    }
}
