<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PagesMusicSearch;
use Illuminate\Support\Facades\Validator;

class PagesMusicSearchController extends Controller
{
    public function create()
    {
        $pagesmusicsearch = PagesMusicSearch::first();
        $pageTitle = "Music Search";
        return view('admin.pages.musicsearch.create', compact('pagesmusicsearch', 'pageTitle'));
    }

    public function store(Request $request)
    {
        $pagesmusicsearch = PagesMusicSearch::first();
        if(!$pagesmusicsearch) {
            $validator = Validator::make($request->all(), [
                'headerimg' => 'required|image|mimes:jpg,png,jpeg|dimensions:width=1800,height=476',
            ],[
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
                'headerimg' => 'image|mimes:jpg,png,jpeg|dimensions:width=1800,height=476',
            ],[
                'headerimg.image' => 'Header Image must be an image!',
                'headerimg.mimes' => 'Header Image must be a jpg, png, jpeg!',
                'headerimg.dimensions' => 'Header Image dimensions must be 1800x476!',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        if($request->hasFile('headerimg')) {
            $alreadyExist = public_path('admin-assets/images/'.$pagesmusicsearch->headerimg);
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
            $image = $pagesmusicsearch->headerimg;
        }

        if(!$pagesmusicsearch) {
            $pagesmusicsearch = new PagesMusicSearch;
        }
        $pagesmusicsearch->headerimg = $image;
        $pagesmusicsearch->save();

        return redirect()->back()->with('success', 'Music Search Content updated successfully');
    }
       
}
