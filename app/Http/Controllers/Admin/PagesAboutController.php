<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PagesAbout;
use Illuminate\Support\Facades\Validator;

class PagesAboutController extends Controller
{
    public function create()
    {
        $pagesabout = PagesAbout::first();
        $pageTitle = "About";
        return view('admin.pages.about.create', compact('pagesabout', 'pageTitle'));
    }

    public function store(Request $request)
    {
        $pagesabout = PagesAbout::first();
        if(!$pagesabout) {
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
            $alreadyExist = public_path('admin-assets/images/'.$pagesabout->headerimg);
            if(file_exists($alreadyExist)) {
                unlink($alreadyExist);
            }

            $image = $request->file('headerimg');
            //$name = $image->getClientOriginalExtension();
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('admin-assets/images');
            $image->move($destinationPath, $name);
            $image = $name;
        }else {
            $image = $pagesabout->headerimg;
        }

        if(!$pagesabout) {
            $pagesabout = new PagesAbout;
        }
        $pagesabout->text = $request->text;
        $pagesabout->headerimg = $image;
        $pagesabout->save();

        return redirect()->back()->with('success', 'About Page Content Updated Successfully!');
    }

}
