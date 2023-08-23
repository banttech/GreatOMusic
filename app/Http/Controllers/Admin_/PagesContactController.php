<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PagesContact;
use Illuminate\Support\Facades\Validator;

class PagesContactController extends Controller
{
    public function create()
    {
        $pagescontact = Pagescontact::first();
        $pageTitle = "Pages";
        return view('admin.pages.contact.create', compact('pagescontact', 'pageTitle'));
    }

    public function store(Request $request)
    {
        $pagescontact = Pagescontact::first();
        if(!$pagescontact) {
            $validator = Validator::make($request->all(), [
                'headerimg' => 'required|image|mimes:jpg,png,jpeg|dimensions:width=1800,height=476',
            ],[
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
                'headerimg' => 'image|mimes:jpg,png,jpeg|dimensions:width=1800,height=476',
            ],[
                'headerimg.image' => 'Header Image must be an image!',
                'headerimg.mimes' => 'Header Image must be a jpg, png, jpeg!',
                'headerimg.dimensions' => 'Header Image dimensions must be 1800x476!',
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        if($request->hasFile('headerimg')) {
            $alreadyExist = public_path('admin-assets/images/'.$pagescontact->headerimg);
            if(file_exists($alreadyExist)) {
                unlink($alreadyExist);
            }

            $image = $request->file('headerimg');
            $name = $image->getClientOriginalExtension();
            $destinationPath = public_path('admin-assets/images');
            $image->move($destinationPath, $name);
            $image = $name;
        }else {
            $image = $pagescontact->headerimg;
        }

        if(!$pagescontact) {
            $pagescontact = new PagesContact;
        }
        $pagescontact->headerimg = $image;
        $pagescontact->save();

        return redirect()->back()->with('success', 'Contact Content updated successfully');
    }
}
