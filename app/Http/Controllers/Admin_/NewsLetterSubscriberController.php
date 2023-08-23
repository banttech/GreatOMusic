<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsLetterSubscriber;

class NewsLetterSubscriberController extends Controller
{
  public function index()
  {
    $subscribers = NewsLetterSubscriber::orderBy('id', 'desc')->get();
    $pageTitle = 'Manage Subscribers';
    return view('admin.newslettersubscriber.index', compact('subscribers', 'pageTitle'));
  }

  public function delete($id)
  {
    NewsLetterSubscriber::find($id)->delete();
    return redirect()->back()->with('success', 'Unsubscribed  successfully');
  }
}
