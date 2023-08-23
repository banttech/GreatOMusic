<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artist;
use Throwable;

class ArtistController extends Controller
{
  public function index()
  {
    $artists = Artist::paginate(50);
    $pageTitle = 'Manage artist';
    return view('admin.artist.index', compact('artists', 'pageTitle'));
  }
  public function search(Request $request)
  {
      $search = $request->get('search');
      $artists = Artist::where('name','like', '%' . $search . '%')
      ->orderBy('id')
      ->paginate(10);
      $pageTitle = 'Manage artist';
      return view('admin.artist.index', compact('artists', 'pageTitle','search'));
  }

  public function create(){
    $pagetitle='Add artist';
    return view('admin.artist.create',compact('pagetitle'));
  }

  public function store(Request $request){
    $request->validate([
    'name' => 'required|unique:artist,name',
    ],
    [
      'name.required' => 'Name field is required!',
    ]);

    $artist = new Artist;
    $artist->name = $request['name'];
    $artist->save();
    
    return redirect()->route('artist')->with('success', 'artist added successfully');
  }

  public function edit($id)
  {
    $pageTitle = 'Edit artist';
    $artists = Artist::find($id);
    return view('admin.artist.edit', compact('pageTitle', 'artists'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'name' => 'required|unique:artist,name,'.$id, 
    ], [
    'name.required' => 'Name field is required',
    ]);
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
