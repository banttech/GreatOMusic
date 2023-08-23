<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $licenses = DB::table('license')->get();
        $pageTitle = "Manage Reports";
        return view('admin.report.index', compact('licenses','pageTitle'));
    }
}
