<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PagesHome;
use App\Models\MusicTitle;
use Illuminate\Support\Facades\Validator;

class PagesHomeController extends Controller
{
    public function create()
    {
        $pageshome = PagesHome::first();
        $pagesmusictitles = MusicTitle::get();
        $pageTitle = "Pages";
        return view('admin.pages.home.create', compact('pageshome', 'pagesmusictitles', 'pageTitle'));
    }

    public function store(Request $request)
    {
        $pageshome = PagesHome::first();
        $validator = Validator::make($request->all(), [
            'text' => 'required',
            'news_heading' => 'required',
            'news_sub_heading' => 'required',
            'news_image' => ($pageshome && $pageshome->news_image != null) ? '' : 'required|dimensions:width=2000,height=570',
        ],[
            'text.required' => 'Text field is required!',
            'news_heading.required' => 'News Heading field is required!',
            'news_sub_heading.required' => 'News Sub Heading field is required!',
            'news_image.required' => 'News Image field is required!',
            'news_image.dimensions' => 'News Image dimensions should be 2000x570!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // check if image is uploaded then upload it
        if($request->hasFile('news_image')) {
            $image = $request->file('news_image');
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('admin-assets/images');
            $alreadyExist = public_path('admin-assets/images/'.$name);
            $image->move($destinationPath, $name);
            $image = $name;
        }else {
            $image = $pageshome->news_image;
        }

        // check if already home page exist then update it else create it
        
        if($pageshome) {
            $pageshome->text = $request->text;
            $pageshome->music_player_title_id = $request->musictitle_id;
            $pageshome->news_heading = $request->news_heading;
            $pageshome->news_sub_heading = $request->news_sub_heading;
            $pageshome->news_image = $image;
            $pageshome->save();
            return redirect()->back()->with('success', 'Home page updated successfully!');
        }else {
            $newHomePage = new PagesHome();
            $newHomePage->text = $request->text;
            $newHomePage->music_player_title_id = $request->musictitle_id;
            $newHomePage->news_heading = $request->news_heading;
            $newHomePage->news_sub_heading = $request->news_sub_heading;
            $newHomePage->news_image = $image;
            $newHomePage->save();
            return redirect()->back()->with('success', 'Home page created successfully!');
        }
    }

}
