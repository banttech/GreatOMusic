<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function index()
    {
        $pageTitle = "Settings";
        $settings = Setting::first();
        return view('admin.settings.index', compact('pageTitle', 'settings'));
    }

    public function store(Request $request){
        $settings = Setting::first();
        if(!$settings){
            $request->validate([
                'logo' => 'required|image|mimes:jpg,png,jpeg|dimensions:width=1454,height=175',
                'facebook_url' => 'required',
                'twitter_url' => 'required',
                'youtube_url' => 'required',
                'sending_mail' => 'required',
                'receiving_mail' => 'required',
            ],[
                'logo.required' => 'Logo field is required!',
                'logo.image' => 'Logo must be an image!',
                'logo.mimes' => 'Logo must be a jpg, png, jpeg!',
                'logo.dimensions' => 'Logo dimensions must be 1454x175!',
                'facebook_url.required' => 'Facebook URL field is required!',
                'twitter_url.required' => 'Twitter URL field is required!',
                'youtube_url.required' => 'Youtube URL field is required!',
                'sending_mail.required' => 'Sending Mail field is required!',
                'receiving_mail.required' => 'Receiving Mail field is required!',
            ]);
        } else {
            $request->validate([
                'logo' => 'image|mimes:jpg,png,jpeg|dimensions:width=1454,height=175',
                'facebook_url' => 'required',
                'twitter_url' => 'required',
                'youtube_url' => 'required',
                'sending_mail' => 'required',
                'receiving_mail' => 'required',
            ],[
                'logo.image' => 'Logo must be an image!',
                'logo.mimes' => 'Logo must be a jpg, png, jpeg!',
                'logo.dimensions' => 'Logo dimensions must be 1454x175!',
                'facebook_url.required' => 'Facebook URL field is required!',
                'twitter_url.required' => 'Twitter URL field is required!',
                'youtube_url.required' => 'Youtube URL field is required!',
                'sending_mail.required' => 'Sending Mail field is required!',
                'receiving_mail.required' => 'Receiving Mail field is required!',
            ]);
        }

        if($request->hasFile('logo')){
            $logo = $request->file('logo');
            $logoName = time().'_'.$logo->getClientOriginalName();
            $logo->move(public_path('admin-assets/images'), $logoName);
        }else{
            $logoName = $settings->logo;
        }

        if(!$settings){
            $settings = new Setting();
        }

        $settings->logo = $logoName;
        $settings->facebook_url = $request->facebook_url;
        $settings->twitter_url = $request->twitter_url;
        $settings->youtube_url = $request->youtube_url;
        $settings->sending_mail = $request->sending_mail;
        $settings->receiving_mail = $request->receiving_mail;
        $settings->save();

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
}