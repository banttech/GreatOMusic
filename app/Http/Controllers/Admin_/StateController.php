<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use Illuminate\Support\Facades\Validator;

class StateController extends Controller
{
    public function index()
    {
   $states = State::all();
   $pageTitle = 'Manage State';
   return view('admin.state.index', compact('states', 'pageTitle'));
  }
  public function search(Request $request)
  {
    $search = $request->get('search');
    $states = State::where('name','like', '%' . $search . '%')->orwhere('code','like', '%' . $search . '%')
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
    $validator = Validator::make($request->all(), [
     'name' => 'required',
     'code' => 'required',
    ],[
      'name.required' => 'State Name field is required!',
      'code.required' => 'State Code field is required!',
    ]);

    if($validator->fails()){
      return redirect()->back()->withErrors($validator)->withInput();
    }
    
    $states = new State;
    $states->name = $request['name'];
    $states->code = $request['code'];
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
    $validator = Validator::make($request->all(), [
      'name' => 'required',  
      'code' => 'required', 
    ], [
    'name.required' => 'State Name field is required',
    'code.required' => 'State Name field is required',
    ]);
    if($validator->fails()){
      return redirect()->back()->withErrors($validator)->withInput();
    }
    $states = State::find($id);
    $states->name = $request['name'];
    $states->code = $request['code'];
    $states->save(); 
   
     return redirect()->route('state')->with('success', 'State updated successfully');  
  }
  
  public function delete($id){
    State::find($id)->delete();            
   return redirect()->back()->with('success', 'State deleted successfully');  
     }
}
