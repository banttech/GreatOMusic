<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PagesMusicSearch;

class PagesMusicSearchController extends Controller
{
    public function create()
    {
        $pagesmusicsearch = PagesMusicSearch::first();
        $pageTitle = "Pages";
        return view('admin.pages.musicsearch.create', compact('pagesmusicsearch', 'pageTitle'));
    }

    public function store(Request $request)
    {
        $pagesmusicsearch = PagesMusicSearch::first();
        if(!$pagesmusicsearch) {
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
            $alreadyExist = public_path('admin-assets/images/'.$pagesmusicsearch->header_image);
            if(file_exists($alreadyExist)) {
                unlink($alreadyExist);
            }

            $image = $request->file('header_image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('admin-assets/images');
            $image->move($destinationPath, $name);
            $image = $name;
        }else {
            $image = $pagesmusicsearch->header_image;
        }

        if(!$pagesmusicsearch) {
            $pagesmusicsearch = new PagesMusicSearch;
        }
        $pagesmusicsearch->header_image = $image;
        $pagesmusicsearch->save();

        return redirect()->back()->with('success', 'Music Search Content updated successfully');
    }
       
}
