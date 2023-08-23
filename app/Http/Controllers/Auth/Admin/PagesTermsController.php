<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PagesTerms;


class PagesTermsController extends Controller
{
    public function create()
    {
        $pagesterms = PagesTerms::first();
        $pageTitle = "Pages";
        return view('admin.pages.terms.create', compact('pagesterms', 'pageTitle'));
    }

    public function store(Request $request)
    {
        $pagesterms = PagesTerms::first();
        if(!$pagesterms) {
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
            $alreadyExist = public_path('admin-assets/images/'.$pagesterms->header_image);
            if(file_exists($alreadyExist)) {
                unlink($alreadyExist);
            }

            $image = $request->file('header_image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('admin-assets/images');
            $image->move($destinationPath, $name);
            $image = $name;
        }else {
            $image = $pagesterms->header_image;
        }

        if(!$pagesterms) {
            $pagesterms = new PagesTerms;
        }
        $pagesterms->text = $request->text;
        $pagesterms->header_image = $image;
        $pagesterms->save();

        return redirect()->back()->with('success', 'Terms Content updated successfully');
    }
}
