<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Term;
use Illuminate\Support\Facades\Validator;

class TermController extends Controller
{
 public function index()
  {
 $terms = Term::all();
 $pageTitle = 'Manage Term';
 return view('admin.term.index', compact('terms', 'pageTitle'));
}
public function search(Request $request)
{
  $search = $request->get('search');
  $terms = Term::where('name','like', '%' . $search . '%')
  ->orderBy('id')
  ->paginate(10);
  $pageTitle = 'Manage Term';
    return view('admin.term.index', compact('terms', 'pageTitle','search'));
}


 public function create(){
  $pageTitle='Add Term';
  return view('admin.term.create',compact('pageTitle'));
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

  $terms = new Term;
  $terms->name = $request['name'];
  $terms->save();

  return redirect()->route('term')->with('success', 'Term added successfully');

}

public function edit($id)
{
 $pageTitle = 'Edit Term';
 $terms = Term::find($id);
 return view('admin.term.edit', compact('pageTitle', 'terms'));
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
  $terms = Term::find($id);
  $terms->name = $request['name'];
  $terms->save(); 
 
   return redirect()->route('term')->with('success', 'Term updated successfully');  
}

public function delete($id){
 Term::find($id)->delete();            
 return redirect()->back()->with('success', 'Term deleted successfully');  
   }
}
