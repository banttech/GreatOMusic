<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Term;
class TermController extends Controller
{
 public function index()
  {
 $terms = Term::paginate(10);
 $pageTitle = 'Manage Term';
 return view('admin.term.index', compact('terms', 'pageTitle'));
}
public function search(Request $request)
{
  $search = $request->get('search');
  $terms = Term::where('term_name','like', '%' . $search . '%')
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
  $request->validate([
   'termname' => 'required',
 ],
 [
  'termname.required' => 'Name field is required!',
  ]

);

$terms = new Term;
$terms->term_name = $request['termname'];
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
  $request->validate([
    'termname' => 'required',   
  ], [
  'termname.required' => 'Name field is required',
  ]);
  $terms = Term::find($id);
  $terms->term_name = $request['termname'];
  $terms->save(); 
 
   return redirect()->route('term')->with('success', 'Term updated successfully');  
}

public function delete($id){
 Term::find($id)->delete();            
 return redirect()->back()->with('success', 'Term deleted successfully');  
   }
}
