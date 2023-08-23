<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();
        $pageTitle = 'Manage Coupons';
        return view('admin.coupon.index', compact('coupons', 'pageTitle'));
    }

    public function create()
    {
        $pageTitle = 'Add Coupon';
        return view('admin.coupon.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:coupon',
            'status' => 'required',
            'usage_allowed' => ['required', 'min:0'],
            'usage_limit' => ['min:0'],
            'discount_percentage' => ['required', 'min:0'],
            'valid_from' => 'required',
            'valid_to' => 'required|after:valid_from',
            'description' => 'required',
        ], [
            'code.required' => 'Coupon Code field is required!',
            'code.unique' => 'Coupon Code already exists!',
            'status.required' => 'Status field is required!',
            'usage_allowed.required' => 'Usage Allowed field is required!',
            'usage_allowed.min' => 'Usage Allowed field must be greater than 0!',
            'usage_limit.min' => 'Usage Limit field must be greater than 0!',
            'discount_percentage.required' => 'Discount Amount field is required!',
            'discount_percentage.min' => 'Discount Amount field must be greater than 0!',
            'valid_from.required' => 'Valid From field is required!',
            'valid_to.required' => 'Valid To field is required!',
            'valid_to.after' => 'Valid To must be a date after Valid From.',
            'description.required' => 'Description field is required!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $coupons = new Coupon;
        $coupons->code = $request['code'];
        $coupons->status = $request['status'];
        $coupons->usage_allowed = $request['usage_allowed'];
        $coupons->usage_limit = $request['usage_limit'] ? $request['usage_limit'] : '';
        $coupons->discount_percentage = $request['discount_percentage'];
        $coupons->valid_from = $request['valid_from'];
        $coupons->valid_to = $request['valid_to'];
        $coupons->description = $request['description'];
        $coupons->save();

        return redirect()->route('coupon')->with('success', 'Coupon added successfully');
    }

    public function edit($id)
    {
        $pageTitle = 'Edit Coupon';
        $coupon = Coupon::find($id);
        return view('admin.coupon.edit', compact('pageTitle', 'coupon'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:coupon,code,' . $id,
            'status' => 'required',
            'usage_allowed' => ['required', 'min:0'],
            'usage_limit' => ['min:0'],
            'discount_percentage' => ['required', 'min:0'],
            'valid_from' => 'required',
            'valid_to' => 'required|after:valid_from',
            'description' => 'required',
        ], [
            'code.required' => 'Coupon Code field is required!',
            'code.unique' => 'Coupon Code already exists!',
            'status.required' => 'Status field is required!',
            'usage_allowed.required' => 'Usage Allowed field is required!',
            'usage_allowed.min' => 'Usage Allowed field must be greater than 0!',
            'usage_limit.min' => 'Usage Limit field must be greater than 0!',
            'discount_percentage.required' => 'Discount Amount field is required!',
            'discount_percentage.min' => 'Discount Amount field must be greater than 0!',
            'valid_from.required' => 'Valid From field is required!',
            'valid_to.required' => 'Valid To field is required!',
            'valid_to.after' => 'Valid To must be a date after Valid From.',
            'description.required' => 'Description field is required!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $coupons = Coupon::find($id);
        $coupons->code = $request['code'];
        $coupons->status = $request['status'];
        $coupons->usage_allowed = $request['usage_allowed'];
        $coupons->usage_limit = ($request['usage_allowed'] == 'limited') ? $request['usage_limit'] : '';
        $coupons->discount_percentage = $request['discount_percentage'];
        $coupons->valid_from = $request['valid_from'];
        $coupons->valid_to = $request['valid_to'];
        $coupons->description = $request['description'];
        $coupons->save();

        return redirect()->route('coupon')->with('success', 'Coupon updated successfully');
    }

    public function delete($id)
    {
        $coupons = Coupon::find($id);
        $coupons->delete();
        return redirect()->route('coupon')->with('success', 'Coupon deleted successfully');
    }
}
