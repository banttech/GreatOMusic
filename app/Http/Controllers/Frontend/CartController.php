<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsLetterSubscriber;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use App\Models\MusicTitle;
use App\Models\License;
use App\Models\Coupon;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function cart(Request $request)
    {
        $pageTitle = 'Great "O" Music - Cart';
        if (Auth::check()) {
            $cart_items = Cart::where('user_id', Auth::user()->id)->where('status', 1)->get();
        } else {
            return redirect()->route('frontend.login');
            $cart_items = [];
        }
        return view('frontend.cart', compact('pageTitle', 'cart_items'));
    }

    public function addToCart(Request $request)
    {

        // check if user is not logged in then redirect to login page and store the current url in session
        if (!Auth::check()) {
            $file = $request->file;
            $cart_item = $request->cart_item;
            $pageTitle = 'License';
            return redirect()->route('frontend.license', ['id'=>$request->id,'file' => $file, 'cart_item' => $cart_item]);
        }

        // store in cart table
        $music = MusicTitle::where('id', $request->id)->first();
        // dd($music);
        $cart = new Cart();
        $cart->user_id = Auth::user()->id;
        $cart->track_id = $music->id;
        $cart->status = 1;
        $cart->price = $music->price;
        $cart->save();

        return redirect()->route('frontend.license', ['id'=>$request->id,'file' => $request->file, 'cart_item' => $cart->id]);
    }

    public function saveCartValues(Request $request)
    {
        $file = $request->file;
        $cart_item = $request->cart_item;
        $id = $request->id;

        $cart = Cart::where('id', $cart_item)->first();
        if ($request->license) {
            $cart->license = $request->license;
        }

        if ($request->territory) {
            $cart->territory = $request->territory;
        }

        if ($request->term) {
            $cart->term = $request->term;
        }
        $cart->save();

        if ($cart->license && $cart->territory && $cart->term) {
            $license = License::where('name', $cart->license)->where('territory', $cart->territory)->where('term', $cart->term)->first();
            $cart->price = $license->price;
            $cart->save();
        }

        return redirect()->route('frontend.license', ['id' => $id, 'file' => $file, 'cart_item' => $cart_item]);
    }

    public function saveCompanyInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
            'legal_name' => 'required',
            'address' => 'required',
            'project' => 'required',
        ], [
            'company_name.required' => 'This field is required.',
            'legal_name.required' => 'This field is required.',
            'address.required' => 'This field is required.',
            'project.required' => 'This field is required.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $pageTitle = 'License';
        $file = $request->file;
        $cart_item = $request->cart_item;

        $cart = Cart::where('id', $cart_item)->first();
        $cart->company_name = $request->company_name;
        $cart->legal_name = $request->legal_name;
        $cart->address = $request->address;
        $cart->project = $request->project;
        $cart->save();

        return redirect()->route('frontend.license', ['id'=>$request->id,'file' => $file, 'cart_item' => $cart_item]);
    }

    public function license(Request $request)
    {
        $pageTitle = 'License';
        $file = $request->file;
        $cart_item = $request->cart_item;
        $id = $request->id;
        $pageTitle = "Great “O” Music - License";
        return view('frontend.license', compact('pageTitle', 'file', 'cart_item','id'));
    }

    public function licenseEdit(Request $request)
    {
        $pageTitle = 'Edit License';
        $cart_item = $request->cart_item;
        $cart = Cart::where('id', $cart_item)->first();
        $totalLicenses = License::select('name')->distinct()->get();
        $totalTerritories = License::where('name', $cart->license)->select('territory')->distinct()->get();
        $totalTerms = License::where('name', $cart->license)->where('territory', $cart->territory)->select('term')->distinct()->get();
        return view('frontend.license-edit', compact('pageTitle', 'cart', 'totalLicenses', 'totalTerritories', 'totalTerms'));
    }

    public function handleChange(Request $request)
    {
        $license = $request->license;
        $territory = $request->territory;
        $term = $request->term;

        $totalTerritories = License::where('name', $license)->select('territory')->distinct()->get();
        $totalTerms = License::where('name', $license)->where('territory', $territory)->select('term')->distinct()->get();

        $totalTerritoriesHtml = '';
        foreach ($totalTerritories as $territoryItem) {
            $selected = ($territoryItem->territory === $territory) ? 'selected' : '';
            $totalTerritoriesHtml .= '<option value="' . $territoryItem->territory . '" ' . $selected . '>' . $territoryItem->territory . '</option>';
        }

        $totalTermsHtml = '';
        foreach ($totalTerms as $termItem) {
            $selected = ($termItem->term === $term) ? 'selected' : '';
            $totalTermsHtml .= '<option value="' . $termItem->term . '" ' . $selected . '>' . $termItem->term . '</option>';
        }

        $totalPrice = License::where('name', $license)->where('territory', $territory)->where('term', $term)->first();
        $totalPriceHtml = $totalPrice ? '$' . $totalPrice->price . ' USD' : null;

        return response()->json([
            'totalTerritoriesHtml' => $totalTerritoriesHtml,
            'totalTermsHtml' => $totalTermsHtml,
            'totalPriceHtml' => $totalPriceHtml,
        ]);
    }

    public function updateLicense(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
            'legal_name' => 'required',
            'address' => 'required',
            'project' => 'required',
            'license' => 'required',
            'territory' => 'required',
            'term' => 'required',
        ], [
            'company_name.required' => 'This field is required.',
            'legal_name.required' => 'This field is required.',
            'address.required' => 'This field is required.',
            'project.required' => 'This field is required.',
            'license.required' => 'This field is required.',
            'territory.required' => 'This field is required.',
            'term.required' => 'This field is required.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $pageTitle = 'License';
        $file = $request->file;
        $cart_item = $request->cart_item;

        $cart = Cart::where('id', $cart_item)->first();
        $cart->company_name = $request->company_name;
        $cart->legal_name = $request->legal_name;
        $cart->address = $request->address;
        $cart->project = $request->project;
        $cart->license = $request->license;
        $cart->territory = $request->territory;
        $cart->term = $request->term;
        $license = License::where('name', $request->license)->where('territory', $request->territory)->where('term', $request->term)->first();
        $cart->price = $license->price;
        $cart->save();

        return redirect()->route('frontend.license', ['id'=>$request->id,'file' => $file, 'cart_item' => $cart_item])->with('success', 'License updated successfully.');
    }

    public function removeCartItem($id)
    {
        $cart = Cart::where('id', $id)->delete();
        // dd($cart);
        return redirect()->route('frontend.cart')->with('success', 'Cart item removed successfully.');
    }

    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::whereRaw('BINARY code = ?', [$request->coupon])->first();

        // $coupon = Coupon::where('code', $request->coupon)->first();
        if ($coupon) {
            // check if coupon status is active or not
            if ($coupon->status == 'inactive') {
                return response()->json([
                    'res_status' => 'error',
                    'message' => 'Coupon is inactive.',
                ]);
            }
            // check if coupon usage_allowed in limited then check if user already used this coupon code
            if ($coupon->usage_allowed == 'limited') {
                // check if coupon usage limit exceeded
                $totalPeopleUsed = Cart::where('coupon_code', $request->coupon)->count();
                if ($totalPeopleUsed >= $coupon->usage_limit) {
                    return response()->json([
                        'res_status' => 'error',
                        'message' => 'Coupon usage limit exceeded.',
                    ]);
                }
            }
            // check if user already used this coupon code
            $cart = Cart::where('user_id', Auth::user()->id)->where('coupon_code', $request->coupon)->first();
            if ($cart) {
                return response()->json([
                    'res_status' => 'already_used',
                    'message' => 'Coupon already used.',
                ]);
            } else {
                $cart = Cart::where('id', $request->cart_item)->first();
                $cart->coupon_code = $request->coupon;
                // calulate discount
                $discount = ($cart->price * $coupon->discount_percentage) / 100;
                $cart->coupon_discount = $discount;
                $cart->discount_percent = $coupon->discount_percentage;
                $cart->save();

                // send coupon discount and grand_total in response
                $cart = Cart::where('id', $request->cart_item)->first();
                $coupon_discount = $cart->coupon_discount;
                $grand_total = $cart->price - $coupon_discount;

                return response()->json([
                    'res_status' => 'success',
                    'message' => 'Coupon applied successfully.',
                    'coupon_discount' => $coupon_discount,
                    'grand_total' => $grand_total,
                ]);
            }
        } else {
            return response()->json([
                'res_status' => 'error',
                'message' => 'Invalid coupon code.',
            ]);
        }
    }

    public function removeCoupon(Request $request)
    {
        $cart = Cart::where('id', $request->cart_item)->first();
        $cart->coupon_code = null;
        $cart->coupon_discount = null;
        $cart->discount_percent = null;
        $cart->save();

        // send coupon discount and grand_total in response
        $cart = Cart::where('id', $request->cart_item)->first();
        $coupon_discount = $cart->coupon_discount;
        $grand_total = $cart->price - $coupon_discount;

        return response()->json([
            'res_status' => 'success',
            'message' => 'Coupon removed successfully.',
            'coupon_discount' => $coupon_discount,
            'grand_total' => $grand_total,
        ]);
    }
}
