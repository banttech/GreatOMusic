<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
  public function index()
  {
 $genres = Genre::all();
 $pageTitle = 'Manage Genre';
 return view('admin.genre.index', compact('genres', 'pageTitle'));
}
public function search(Request $request)
{
  $search = $request->get('search');
  $genres = Genre::where('name','like', '%' . $search . '%')
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
  $validator = Validator::make($request->all(), [
   'name' => 'required',
  ],[
    'name.required' => 'Name field is required!',
  ]);

  if ($validator->fails()) {
   return redirect()->back()->withErrors($validator)->withInput();
  }
  $genres = new Genre;
  $genres->name = $request['name'];
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
  $validator = Validator::make($request->all(), [
    'name' => 'required',
  ],[
    'name.required' => 'Name field is required!',
  ]);
  $genres = Genre::find($id);
  $genres->name = $request['name'];
  $genres->save(); 
 
   return redirect()->route('genre')->with('success', 'Genre updated successfully');  
}

public function delete($id){
 Genre::find($id)->delete();            
 return redirect()->back()->with('success', 'Genre deleted successfully');  
   }
  }
