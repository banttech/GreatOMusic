<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tempo;
use Illuminate\Support\Facades\Validator;

class TempoController extends Controller
{
  public function index()
  {
 $tempos = Tempo::all();
 $pageTitle = 'Manage Tempo';
 return view('admin.tempo.index', compact('tempos', 'pageTitle'));
}
public function search(Request $request)
{
  $search = $request->get('search');
  $tempos = Tempo::where('name','like', '%' . $search . '%')
  ->orderBy('id')
  ->paginate(10);
  $pageTitle = 'Manage Tempo';
    return view('admin.tempo.index', compact('tempos', 'pageTitle','search'));
}


 public function create(){
  $pageTitle='Add Tempo';
  return view('admin.tempo.create',compact('pageTitle'));
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

    $tempos = new Tempo;
    $tempos->name = $request['name'];
    $tempos->save();

    return redirect()->route('tempo')->with('success', 'Tempo added successfully');

}

public function edit($id)
{
 $pageTitle = 'Edit Tempo';
 $tempos = Tempo::find($id);
 return view('admin.tempo.edit', compact('pageTitle', 'tempos'));
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
  $tempos = Tempo::find($id);
  $tempos->name = $request['name'];
  $tempos->save(); 
 
   return redirect()->route('tempo')->with('success', 'Tempo updated successfully');  
}

public function delete($id){
 Tempo::find($id)->delete();            
 return redirect()->back()->with('success', 'Tempo deleted successfully');  
   }
}
