<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PagesContact;

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
            $request->validate([
                'header_image' => 'required|image|mimes:jpg,png,jpeg|dimensions:width=1800,height=476',
            ],[
                'header_image.required' => 'Header Image field is required!',
                'header_image.image' => 'Header Image must be an image!',
                'header_image.mimes' => 'Header Image must be a jpg, png, jpeg!',
                'header_image.dimensions' => 'Header Image dimensions must be 1800x476!',
            ]);
        }else {
            $request->validate([
                'header_image' => 'image|mimes:jpg,png,jpeg|dimensions:width=1800,height=476',
            ],[
                'header_image.image' => 'Header Image must be an image!',
                'header_image.mimes' => 'Header Image must be a jpg, png, jpeg!',
                'header_image.dimensions' => 'Header Image dimensions must be 1800x476!',
            ]);
        }

        if($request->hasFile('header_image')) {
            $alreadyExist = public_path('admin-assets/images/'.$pagescontact->header_image);
            if(file_exists($alreadyExist)) {
                unlink($alreadyExist);
            }

            $image = $request->file('header_image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('admin-assets/images');
            $image->move($destinationPath, $name);
            $image = $name;
        }else {
            $image = $pagescontact->header_image;
        }

        if(!$pagescontact) {
            $pagescontact = new PagesContact;
        }
        $pagescontact->header_image = $image;
        $pagescontact->save();

        return redirect()->back()->with('success', 'Contact Content updated successfully');
    }
}
