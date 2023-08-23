<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tempo;

class TempoController extends Controller
{
  public function index()
  {
 $tempos = Tempo::paginate(10);
 $pageTitle = 'Manage Tempo';
 return view('admin.tempo.index', compact('tempos', 'pageTitle'));
}
public function search(Request $request)
{
  $search = $request->get('search');
  $tempos = Tempo::where('tempo_name','like', '%' . $search . '%')
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
  $request->validate([
   'temponame' => 'required',
 ],
 [
  'temponame.required' => 'Name field is required!',
  ]

);

$tempos = new Tempo;
$tempos->tempo_name = $request['temponame'];
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
  $request->validate([
    'temponame' => 'required',   
  ], [
  'temponame.required' => 'Name field is required',
  ]);
  $tempos = Tempo::find($id);
  $tempos->tempo_name = $request['temponame'];
  $tempos->save(); 
 
   return redirect()->route('tempo')->with('success', 'Tempo updated successfully');  
}

public function delete($id){
 Tempo::find($id)->delete();            
 return redirect()->back()->with('success', 'Tempo deleted successfully');  
   }
}
