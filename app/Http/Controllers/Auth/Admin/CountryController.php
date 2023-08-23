<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
   $countries = Country::paginate(10);
   $pageTitle = 'Manage Country';
   return view('admin.country.index', compact('countries', 'pageTitle'));
  }
  public function search(Request $request)
  {
    $search = $request->get('search');
    $countries = Country::where('country_name','like', '%' . $search . '%')->orwhere('country_code','like', '%' . $search . '%')
    ->orderBy('id')
    ->paginate(25);
    $pageTitle = 'Manage Country';
      return view('admin.country.index', compact('countries', 'pageTitle','search'));
  }
  
   public function create(){
    $pageTitle='Add country';
    return view('admin.country.create',compact('pageTitle'));
   }
  
   public function store(Request $request){
    $request->validate([
     'countryname' => 'required',
     'countrycode' => 'required',
   ],
   [
    'countryname.required' => 'Country Name field is required!',
    'countrycode.required' => 'Country Code field is required!',
    ]
  
  );
  
  $countries = new Country;
  $countries->country_name = $request['countryname'];
  $countries->country_code = $request['countrycode'];
  $countries->save();
  
  return redirect()->route('country')->with('success', 'Country added successfully');
  
  }
  
  public function edit($id)
  {
   $pageTitle = 'Edit country';
   $countries = Country::find($id);
   return view('admin.country.edit', compact('pageTitle', 'countries'));
  }
  
  public function update(Request $request, $id)
  {
    $request->validate([
      'countryname' => 'required',  
      'countrycode' => 'required', 
    ], [
    'countryname.required' => 'Country Name field is required',
    'countrycode.required' => 'Country Name field is required',
    ]);
    $countries = Country::find($id);
    $countries->country_name = $request['countryname'];
    $countries->country_code = $request['countrycode'];
    $countries->save(); 
   
     return redirect()->route('country')->with('success', 'Country updated successfully');  
  }
  
  public function delete($id){
    Country::find($id)->delete();            
   return redirect()->back()->with('success', 'Country deleted successfully');  
     }
}
