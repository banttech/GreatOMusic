<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Version;

class VersionController extends Controller
{
  public function index()
  {
 $versions = Version::paginate(10);
 $pageTitle = 'Manage Version';
 return view('admin.version.index', compact('versions', 'pageTitle'));
}
public function search(Request $request)
{
  $search = $request->get('search');
  $versions = Version::where('version_name','like', '%' . $search . '%')
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
  $request->validate([
   'versionname' => 'required',
 ],
 [
  'versionname.required' => 'Name field is required!',
  ]

);

$versions = new Version;
$versions->version_name = $request['versionname'];
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
  $request->validate([
    'versionname' => 'required',   
  ], [
  'versionname.required' => 'Name field is required',
  ]);
  $versions = Version::find($id);
  $versions->version_name = $request['versionname'];
  $versions->save(); 
 
   return redirect()->route('version')->with('success', 'Version updated successfully');  
}

public function delete($id){
 Version::find($id)->delete();            
 return redirect()->back()->with('success', 'Version deleted successfully');  
   }
}
