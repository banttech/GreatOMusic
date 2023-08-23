<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    public function index()
    {
   $countries = Country::all();
   $pageTitle = 'Manage Country';
   return view('admin.country.index', compact('countries', 'pageTitle'));
  }
  public function search(Request $request)
  {
    $search = $request->get('search');
    $countries = Country::where('name','like', '%' . $search . '%')->orwhere('code','like', '%' . $search . '%')
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
    $validator = Validator::make($request->all(), [
     'name' => 'required',
     'code' => 'required',
    ],[
      'name.required' => 'Country Name field is required!',
      'code.required' => 'Country Code field is required!',
    ]);

    if($validator->fails()){
      return redirect()->back()->withErrors($validator)->withInput();
    }
  
  $countries = new Country;
  $countries->name = $request['name'];
  $countries->code = $request['code'];
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
    $validator = Validator::make($request->all(), [
      'name' => 'required',  
      'code' => 'required', 
    ], [
    'name.required' => 'Country Name field is required',
    'code.required' => 'Country Name field is required',
    ]);

    if($validator->fails()){
      return redirect()->back()->withErrors($validator)->withInput();
    }
    $countries = Country::find($id);
    $countries->name = $request['name'];
    $countries->code = $request['code'];
    $countries->save(); 
   
     return redirect()->route('country')->with('success', 'Country updated successfully');  
  }
  
  public function delete($id){
    Country::find($id)->delete();            
   return redirect()->back()->with('success', 'Country deleted successfully');  
     }
}
