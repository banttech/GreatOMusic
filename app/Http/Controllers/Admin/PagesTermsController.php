<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PagesTerms;
use Illuminate\Support\Facades\Validator;


class PagesTermsController extends Controller
{
    public function create()
    {
        $pagesterms = PagesTerms::first();
        $pageTitle = "Terms";
        return view('admin.pages.terms.create', compact('pagesterms', 'pageTitle'));
    }

    public function store(Request $request)
    {
        $pagesterms = PagesTerms::first();
        if(!$pagesterms) {
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

            if ($validator->fails()) {
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

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        if($request->hasFile('headerimg')) {
            $alreadyExist = public_path('admin-assets/images/'.$pagesterms->headerimg);
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
            $image = $pagesterms->headerimg;
        }

        if(!$pagesterms) {
            $pagesterms = new PagesTerms;
        }
        $pagesterms->text = $request->text;
        $pagesterms->headerimg = $image;
        $pagesterms->save();

        return redirect()->back()->with('success', 'Terms Content updated successfully');
    }
}
