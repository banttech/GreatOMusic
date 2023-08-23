<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artist;
use Throwable;
use Illuminate\Support\Facades\Validator;

class ArtistController extends Controller
{
  public function index()
  {
    $artists = Artist::orderBy('name','asc')->paginate(50);
    $pageTitle = 'Manage Artists';
    return view('admin.artist.index', compact('artists', 'pageTitle'));
  }
  public function search(Request $request)
  {
      $search = $request->get('search');
      $artists = Artist::where('name','like', '%' . $search . '%')
      ->orderBy('id')
      ->paginate(10);
      $pageTitle = 'Manage Artists';
      return view('admin.artist.index', compact('artists', 'pageTitle','search'));
  }

  public function create(){
    $pageTitle='Add Artist';
    return view('admin.artist.create',compact('pageTitle'));
  }

  public function store(Request $request){
    $validator = Validator::make($request->all(), [
      'name' => 'required|unique:artist,name',
    ],
    [
      'name.required' => 'Name field is required!',
    ]);
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $artist = new Artist;
    $artist->name = $request['name'];
    $artist->count = 0;
    $artist->save();
    
    return redirect()->route('artist')->with('success', 'artist added successfully');
  }

  public function edit($id)
  {
    $pageTitle = 'Edit Artist';
    $artists = Artist::find($id);
    return view('admin.artist.edit', compact('pageTitle', 'artists'));
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|unique:artist,name,'.$id, 
    ], [
      'name.required' => 'Name field is required',
    ]);

    if($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }
    $artist = Artist::find($id);
    $artist->name = $request['name'];
    $artist->save(); 
  
    return redirect()->route('artist')->with('success', 'artist updated successfully');  
  }

  public function delete($id){
    Artist::find($id)->delete();            
    return redirect()->back()->with('success', 'artist deleted successfully');  
  }
}
