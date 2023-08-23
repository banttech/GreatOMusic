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
        return view('admin.purchase.index', compact('licenses'));
    }
}
