<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PagesLicensing;

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
            $request->validate([
                'text' => 'required',
                'header_image' => 'required|image|mimes:jpg,png,jpeg|dimensions:width=1800,height=476',
            ],[
                'text.required' => 'Text field is required!',
                'header_image.required' => 'Header Image field is required!',
                'header_image.image' => 'Header Image must be an image!',
                'header_image.mimes' => 'Header Image must be a jpg, png, jpeg!',
                'header_image.dimensions' => 'Header Image dimensions must be 1800x476!',
            ]);
        }else {
            $request->validate([
                'text' => 'required',
                'header_image' => 'image|mimes:jpg,png,jpeg|dimensions:width=1800,height=476',
            ],[
                'text.required' => 'Text field is required!',
                'header_image.image' => 'Header Image must be an image!',
                'header_image.mimes' => 'Header Image must be a jpg, png, jpeg!',
                'header_image.dimensions' => 'Header Image dimensions must be 1800x476!',
            ]);
        }

        if($request->hasFile('header_image')) {
            $alreadyExist = public_path('admin-assets/images/'.$pageslicensings->header_image);
            if(file_exists($alreadyExist)) {
                unlink($alreadyExist);
            }

            $image = $request->file('header_image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('admin-assets/images');
            $image->move($destinationPath, $name);
            $image = $name;
        }else {
            $image = $pageslicensings->header_image;
        }

        if(!$pageslicensings) {
            $pageslicensings = new PagesLicensing;
        }
        $pageslicensings->text = $request->text;
        $pageslicensings->header_image = $image;
        $pageslicensings->save();

        return redirect()->back()->with('success', 'Licensing Content updated successfully');
    }
}
