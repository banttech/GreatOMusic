<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Territory;
use Illuminate\Support\Facades\Validator;

class TerritoryController extends Controller
{
  public function index()
  {
 $territorys = Territory::all();
 $pageTitle = 'Manage Territory';
 return view('admin.territory.index', compact('territorys', 'pageTitle'));
}
public function search(Request $request)
{
  $search = $request->get('search');
  $territorys = Territory::where('name','like', '%' . $search . '%')
  ->orderBy('id')
  ->paginate(10);
  $pageTitle = 'Manage Territory';
    return view('admin.territory.index', compact('territorys', 'pageTitle','search'));
}

 public function create(){
  $pageTitle='Add Territory';
  return view('admin.territory.create',compact('pageTitle'));
 }

 public function store(Request $request){
  $validator = Validator::make($request->all(), [
   'name' => 'required',
  ],[
    'name.required' => 'Name field is required!',
  ]);

  if($validator->fails()){
    return redirect()->back()->withErrors($validator)->withInput();
  }

  $territorys = new territory;
  $territorys->name = $request['name'];
  $territorys->save();

  return redirect()->route('territory')->with('success', 'Territory added successfully');

}

public function edit($id)
{
 $pageTitle = 'Edit Territory';
 $territorys = Territory::find($id);
 return view('admin.territory.edit', compact('pageTitle', 'territorys'));
}

public function update(Request $request, $id)
{

  $validator = Validator::make($request->all(), [
    'name' => 'required',   
  ], [
  'name.required' => 'Name field is required',
  ]);

  if($validator->fails()){
    return redirect()->back()->withErrors($validator)->withInput();
  }
  $territorys = Territory::find($id);
  $territorys->name = $request['name'];
  $territorys->save(); 
 
   return redirect()->route('territory')->with('success', 'Territory updated successfully');  
}

public function delete($id){
 Territory::find($id)->delete();            
 return redirect()->back()->with('success', 'Territory deleted successfully');  
   }
}
