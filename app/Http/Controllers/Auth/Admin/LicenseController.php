<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\License;
use App\Models\Term;
use App\Models\Territory;

class LicenseController extends Controller
{
  public function index()
  {
 $licenses = License::paginate(10);
 $pageTitle = 'Manage License';
 return view('admin.license.index', compact('licenses', 'pageTitle'));
 }
public function search(Request $request)
{
  $search = $request->get('search');
  $licenses = license::where('license_name','like', '%' . $search . '%')
  ->orderBy('id')
  ->paginate(10);
  $pageTitle = 'Manage license';
    return view('admin.license.index', compact('licenses', 'pageTitle','search'));
}
  
  
   public function create(){
    $pageTitle='Add License';
    $territorys = Territory::paginate(50);
    $terms = Term::paginate(50);
    return view('admin.license.create',compact('pageTitle','territorys','terms'));
   }

   public function store(Request $request){
    $request->validate([
     'licensename' => 'required',
     'text' => 'required',
     'price' => 'required|numeric',
  
   ],
   [
    'licensename.required' => 'Name field is required!',
    'text.required' => 'Text field is required!',
    'price.required' => 'Price field is required!',
    'price.numeric' => 'You can enter only price in this feild',
    
    ]
  
  );
  $licenses = new License;
  $licenses->license_name = $request['licensename'];
  $licenses->text = $request['text'];
  $licenses->territory_id = $request['territory_id'];
  $licenses->term_id = $request['term_id'];
  $licenses->price = $request['price'];
  $licenses->save();

  return redirect()->route('license')->with('success', 'License updated successfully'); 

  }

  public function edit($id)
  {
   $pageTitle = 'Edit license';
   $licenses = License::find($id);
   $territorys = Territory::paginate(50);
   $terms = Term::paginate(50);
  
   return view('admin.license.edit', compact('pageTitle', 'licenses','territorys','terms'));
  }
  
  public function update(Request $request, $id)
  {
    $request->validate([
      'licensename' => 'required',
      'text' => 'required',
      'price' => 'required|numeric',
   
    ],
    [
     'licensename.required' => 'Name field is required!',
     'text.required' => 'Text field is required!',
     'price.required' => 'Price field is required!',
     'price.numeric' => 'You can enter only price in this feild',
     
     ]
   
   );

   $licenses = license::find($id);
   $licenses->license_name = $request['licensename'];
   $licenses->text = $request['text'];
   $licenses->territory_id = $request['territory_id'];
   $licenses->term_id = $request['term_id'];
   $licenses->price = $request['price'];
   $licenses->save();
    //  $licenses = DB::table('license')->find($id);
    //   DB::table('license')->where('id', $id)->update([
    //   'license_name' => $request->licensename,      
    //   ]);
     return redirect()->route('license')->with('success', 'License updated successfully');  
  }
  public function delete($id){
    License::find($id)->delete();          
    return redirect()->route('license')->with('success', 'License deleted successfully');
          
     }
  
  public function dashboard(){
    $pageTitle = 'Great "O" Music - Admin';
    return view('admin.index', compact('pageTitle'));
  }
  
}
