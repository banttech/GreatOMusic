<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        // get license date by desc
        $licenses = DB::table('license')->get();
        $pageTitle = "Manage Purchases";
        return view('admin.purchase.index', compact('licenses','pageTitle'));
    }
    public function delete($id)
    {
        $license = DB::table('license')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'License deleted successfully');
    }
}
