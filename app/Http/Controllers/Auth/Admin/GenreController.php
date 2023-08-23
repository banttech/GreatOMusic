<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;
class GenreController extends Controller
{
  public function index()
  {
 $genres = Genre::paginate(10);
 $pageTitle = 'Manage Genre';
 return view('admin.genre.index', compact('genres', 'pageTitle'));
}
public function search(Request $request)
{
  $search = $request->get('search');
  $genres = Genre::where('genre_name','like', '%' . $search . '%')
  ->orderBy('id')
  ->paginate(10);
  $pageTitle = 'Manage Genre';
    return view('admin.genre.index', compact('genres', 'pageTitle','search'));
}

 public function create(){
  $pageTitle='Add Genre';
  return view('admin.genre.create',compact('pageTitle'));
 }

 public function store(Request $request){
  $request->validate([
   'genrename' => 'required',
 ],
 [
  'genrename.required' => 'Name field is required!',
  ]

);

$genres = new Genre;
$genres->genre_name = $request['genrename'];
$genres->save();

return redirect()->route('genre')->with('success', 'Genre added successfully');

}

public function edit($id)
{
 $pageTitle = 'Edit Genre';
 $genres = Genre::find($id);
 return view('admin.genre.edit', compact('pageTitle', 'genres'));
}

public function update(Request $request, $id)
{
  $request->validate([
    'genrename' => 'required',   
  ], [
  'genrename.required' => 'Name field is required',
  ]);
  $genres = Genre::find($id);
  $genres->genre_name = $request['genrename'];
  $genres->save(); 
 
   return redirect()->route('genre')->with('success', 'Genre updated successfully');  
}

public function delete($id){
 Genre::find($id)->delete();            
 return redirect()->back()->with('success', 'Genre deleted successfully');  
   }
  }
