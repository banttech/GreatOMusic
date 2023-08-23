<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $pageTitle = 'Great "O" Music - Checkout';
        return view('frontend.checkout', compact('pageTitle'));
    }
}
