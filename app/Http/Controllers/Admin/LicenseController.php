<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\License;
use App\Models\Term;
use App\Models\Territory;
use App\Models\MusicTitle;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LicenseController extends Controller
{
  public function index()
  {
    $licenses = License::all();
    $pageTitle = 'Manage License';
    return view('admin.license.index', compact('licenses', 'pageTitle'));
  }
  public function search(Request $request)
  {
    $search = $request->get('search');
    $licenses = license::where('name', 'like', '%' . $search . '%')
      ->orderBy('id')
      ->paginate(10);
    $pageTitle = 'Manage license';
    return view('admin.license.index', compact('licenses', 'pageTitle', 'search'));
  }

  public function create()
  {
    $pageTitle = 'Add License';
    $territorys = Territory::paginate(50);
    $terms = Term::paginate(50);
    return view('admin.license.create', compact('pageTitle', 'territorys', 'terms'));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'text' => 'required',
      'price' => 'required|numeric',

    ], [
      'name.required' => 'Name field is required!',
      'text.required' => 'Text field is required!',
      'price.required' => 'Price field is required!',
      'price.numeric' => 'You can enter only price in this feild',

    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }

    $licenses = new License;
    $licenses->name = $request['name'];
    $licenses->text = $request['text'];
    $licenses->territory = $request['territory'];
    $licenses->term = $request['term'];
    $licenses->price = $request['price'];
    $licenses->save();

    return redirect()->route('license')->with('success', 'License updated successfully');
  }

  public function edit($id)
  {
    $pageTitle = 'Edit License';
    $licenses = License::find($id);
    $territorys = Territory::paginate(50);
    $terms = Term::paginate(50);

    return view('admin.license.edit', compact('pageTitle', 'licenses', 'territorys', 'terms'));
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'text' => 'required',
      'price' => 'required|numeric',

    ], [
      'name.required' => 'Name field is required!',
      'text.required' => 'Text field is required!',
      'price.required' => 'Price field is required!',
      'price.numeric' => 'You can enter only price in this feild',

    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }

    $licenses = license::find($id);
    $licenses->name = $request['name'];
    $licenses->text = $request['text'];
    $licenses->territory = $request['territory'];
    $licenses->term = $request['term'];
    $licenses->price = $request['price'];
    $licenses->save();
    //  $licenses = DB::table('license')->find($id);
    //   DB::table('license')->where('id', $id)->update([
    //   'name' => $request->name,      
    //   ]);
    return redirect()->route('license')->with('success', 'License updated successfully');
  }
  public function delete($id)
  {
    License::find($id)->delete();
    return redirect()->route('license')->with('success', 'License deleted successfully');
  }

  public function dashboard()
  {
    // $license = DB::table('license')->get();
    // foreach ($license as $key => $value) {
    //   $random_id = rand(100000, 999999);
    //   DB::table('license')->where('id', $value->id)->update([
    //     'random_id' => $random_id,
    //   ]);
    // }
    // dd($license);
    $pageTitle = 'Admin';
    return view('admin.index', compact('pageTitle'));
  }

  public function exportCsv()
  {
    // Prepare the data for CSV
    $licenses = DB::table('license')->get();
    $data = [];
    foreach ($licenses as $license) {
      $music = MusicTitle::find($license->track_id);
      $user = User::find($license->user);
      $data[] = [
        $license->id,
        $license->license,
        $music->title . ' | ' . $music->artist,
        $user->email ?? 'N/A',
        $license->territory,
        $license->term,
        // show price in 2 decimal places
        number_format($license->price),
        'USD',
        $license->date,
      ];
    }

    // Define the CSV file name
    $fileName = 'data.csv';

    // Define the headers for the response
    $headers = [
      'Content-type' => 'text/csv',
      'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
      'Pragma' => 'no-cache',
      'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
      'Expires' => '0',
    ];

    // Create the CSV file
    $callback = function () use ($data) {
      $file = fopen('php://output', 'w');

      // Write the header row
      fputcsv($file, [
        'Invoice',
        'License Name',
        'Title',
        'User',
        'Territory',
        'Term',
        'Price',
        'Currency',
        'Date',
      ]);

      // Write the data rows
      foreach ($data as $row) {
        fputcsv($file, $row);
      }

      fclose($file);
    };

    // Return the CSV file as a response
    return response()->stream($callback, 200, $headers);
  }

  public function exportExcel()
  {
    $licenses = DB::table('license')->get();
    $data = [];
    foreach ($licenses as $license) {
      $music = MusicTitle::find($license->track_id);
      $user = User::find($license->user);
      $data[] = [
        $license->id,
        $license->license,
        $music->title . ' | ' . $music->artist,
        $user->email ?? 'N/A',
        $license->territory,
        $license->term,
        // show price in 2 decimal places
        number_format($license->price),
        'USD',
        $license->date,
      ];
    }

    // Create a temporary file path to save the Excel file
    $filePath = sys_get_temp_dir() . '/report.xls';

    // Create a file pointer for writing the Excel file
    $file = fopen($filePath, 'w');

    // Write the Excel file headers
    fwrite($file, "Invoice\tLicense Name\tTitle\tUser\tTerritory\tTerm\tPrice\tCurrency\tDate\n");

    // Write the data rows
    foreach ($data as $row) {
      fwrite($file, implode("\t", $row) . "\n");
    }

    // Close the file pointer
    fclose($file);

    // Define the headers for the response
    $headers = [
      'Content-type' => 'application/vnd.ms-excel',
      'Content-Disposition' => 'attachment; filename="report.xls"',
      'Pragma' => 'no-cache',
      'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
      'Expires' => '0',
    ];

    // Read the Excel file contents and send as a response
    $fileContents = file_get_contents($filePath);
    unlink($filePath); // Delete the temporary file
    return response($fileContents, 200, $headers);
  }
}
