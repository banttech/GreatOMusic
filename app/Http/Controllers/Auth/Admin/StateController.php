<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;

class StateController extends Controller
{
    public function index()
    {
   $states = State::paginate(10);
   $pageTitle = 'Manage State';
   return view('admin.state.index', compact('states', 'pageTitle'));
  }
  public function search(Request $request)
  {
    $search = $request->get('search');
    $states = State::where('state_name','like', '%' . $search . '%')->orwhere('state_code','like', '%' . $search . '%')
    ->orderBy('id')
    ->paginate(25);
    $pageTitle = 'Manage State';
      return view('admin.state.index', compact('states', 'pageTitle','search'));
  }
  
   public function create(){
    $pageTitle='Add State';
    return view('admin.state.create',compact('pageTitle'));
   }
  
   public function store(Request $request){
    $request->validate([
     'statename' => 'required',
     'statecode' => 'required',
   ],
   [
    'statename.required' => 'State Name field is required!',
    'statecode.required' => 'State Code field is required!',
    ]
  
  );
  
  $states = new State;
  $states->state_name = $request['statename'];
  $states->state_code = $request['statecode'];
  $states->save();
  
  return redirect()->route('state')->with('success', 'State added successfully');
  
  }
  
  public function edit($id)
  {
   $pageTitle = 'Edit State';
   $states = State::find($id);
   return view('admin.state.edit', compact('pageTitle', 'states'));
  }
  
  public function update(Request $request, $id)
  {
    $request->validate([
      'statename' => 'required',  
      'statecode' => 'required', 
    ], [
    'statename.required' => 'State Name field is required',
    'statecode.required' => 'State Name field is required',
    ]);
    $states = State::find($id);
    $states->state_name = $request['statename'];
    $states->state_code = $request['statecode'];
    $states->save(); 
   
     return redirect()->route('state')->with('success', 'State updated successfully');  
  }
  
  public function delete($id){
    State::find($id)->delete();            
   return redirect()->back()->with('success', 'State deleted successfully');  
     }
}
