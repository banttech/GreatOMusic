<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PagesLicensing;
use Illuminate\Support\Facades\Validator;

class PagesLicensingController extends Controller
{
    public function create()
    {
        $pageslicensings = PagesLicensing::first();
        $pageTitle = "Pages";
        return view('admin.pages.licensing.create', compact('pageslicensings', 'pageTitle'));
    }

    public function store(Request $request)
    {
        $pageslicensings = PagesLicensing::first();
        if(!$pageslicensings) {
            $validator = Validator::make($request->all(), [
                'text' => 'required',
                'headerimg' => 'required|image|mimes:jpg,png,jpeg|dimensions:width=1800,height=476',
            ],[
                'text.required' => 'Text field is required!',
                'headerimg.required' => 'Header Image field is required!',
                'headerimg.image' => 'Header Image must be an image!',
                'headerimg.mimes' => 'Header Image must be a jpg, png, jpeg!',
                'headerimg.dimensions' => 'Header Image dimensions must be 1800x476!',
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }else {
            $validator = Validator::make($request->all(), [
                'text' => 'required',
                'headerimg' => 'image|mimes:jpg,png,jpeg|dimensions:width=1800,height=476',
            ],[
                'text.required' => 'Text field is required!',
                'headerimg.image' => 'Header Image must be an image!',
                'headerimg.mimes' => 'Header Image must be a jpg, png, jpeg!',
                'headerimg.dimensions' => 'Header Image dimensions must be 1800x476!',
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        if($request->hasFile('headerimg')) {
            $alreadyExist = public_path('admin-assets/images/'.$pageslicensings->headerimg);
            if(file_exists($alreadyExist)) {
                unlink($alreadyExist);
            }

            $image = $request->file('headerimg');
            $name = $image->getClientOriginalExtension();
            $destinationPath = public_path('admin-assets/images');
            $image->move($destinationPath, $name);
            $image = $name;
        }else {
            $image = $pageslicensings->headerimg;
        }

        if(!$pageslicensings) {
            $pageslicensings = new PagesLicensing;
        }
        $pageslicensings->text = $request->text;
        $pageslicensings->headerimg = $image;
        $pageslicensings->save();

        return redirect()->back()->with('success', 'Licensing Content updated successfully');
    }
}
