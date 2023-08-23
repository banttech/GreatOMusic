<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artist;
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
  $artists = Artist::where('artist_name','like', '%' . $search . '%')
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
   'artistname' => 'required',
 ],
 [
  'artistname.required' => 'Name field is required!',
  ]

);

$artists = new Artist;
$artists->artist_name = $request['artistname'];
$artists->save();

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
    'artistname' => 'required',   
  ], [
  'artistname.required' => 'Name field is required',
  ]);
  $artists = Artist::find($id);
  $artists->artist_name = $request['artistname'];
  $artists->save(); 
 
   return redirect()->route('artist')->with('success', 'artist updated successfully');  
}

public function delete($id){
 Artist::find($id)->delete();            
 return redirect()->back()->with('success', 'artist deleted successfully');  
   }
}
