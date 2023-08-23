<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Version;
use Illuminate\Support\Facades\Validator;

class VersionController extends Controller
{
  public function index()
  {
 $versions = Version::all();
 $pageTitle = 'Manage Version';
 return view('admin.version.index', compact('versions', 'pageTitle'));
}
public function search(Request $request)
{
  $search = $request->get('search');
  $versions = Version::where('name','like', '%' . $search . '%')
  ->orderBy('id')
  ->paginate(10);
  $pageTitle = 'Manage Version';
    return view('admin.version.index', compact('versions', 'pageTitle','search'));
}

 public function create(){
  $pageTitle='Add Version';
  return view('admin.version.create',compact('pageTitle'));
 }

 public function store(Request $request){
  $validator = Validator::make($request->all(), [
   'name' => 'required',
  ],[
    'name.required' => 'Name field is required!',
  ]);

  if ($validator->fails()) {
    return redirect()->back()->withErrors($validator)->withInput();
  }

  $versions = new Version;
  $versions->name = $request['name'];
  $versions->save();

  return redirect()->route('version')->with('success', 'Version added successfully');

}

public function edit($id)
{
 $pageTitle = 'Edit Version';
 $versions = Version::find($id);
 return view('admin.version.edit', compact('pageTitle', 'versions'));
}

public function update(Request $request, $id)
{
  $validator = Validator::make($request->all(), [
    'name' => 'required',   
  ], [
  'name.required' => 'Name field is required',
  ]);

  if ($validator->fails()) {
    return redirect()->back()->withErrors($validator)->withInput();
  }
  $versions = Version::find($id);
  $versions->name = $request['name'];
  $versions->save(); 
 
   return redirect()->route('version')->with('success', 'Version updated successfully');  
}

public function delete($id){
 Version::find($id)->delete();            
 return redirect()->back()->with('success', 'Version deleted successfully');  
   }
}
