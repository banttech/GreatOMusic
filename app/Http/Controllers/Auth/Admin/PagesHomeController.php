<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PagesHome;
use App\Models\MusicTitle;

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
        $request->validate([
            'text' => 'required',
            'news_heading' => 'required',
            'news_sub_heading' => 'required',
        ],[
            'text.required' => 'Text field is required!',
            'news_heading.required' => 'News Heading field is required!',
            'news_sub_heading.required' => 'News Sub Heading field is required!',
        ]);

        // check if already home page exist then update it else create it
        if($pageshome) {
            $pageshome->text = $request->text;
            $pageshome->music_player_title_id = $request->musictitle_id;
            $pageshome->news_heading = $request->news_heading;
            $pageshome->news_sub_heading = $request->news_sub_heading;
            $pageshome->save();
            return redirect()->back()->with('success', 'Home page updated successfully!');
        }else {
            $newHomePage = new PagesHome();
            $newHomePage->text = $request->text;
            $newHomePage->music_player_title_id = $request->musictitle_id;
            $newHomePage->news_heading = $request->news_heading;
            $newHomePage->news_sub_heading = $request->news_sub_heading;
            $newHomePage->save();
            return redirect()->back()->with('success', 'Home page created successfully!');
        }
    }

}
