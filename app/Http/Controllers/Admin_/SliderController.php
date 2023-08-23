<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
  public function index()
  {
   $sliders = Slider::all();
   $pageTitle = 'Manage Slider';
   return view('admin.slider.index', compact('sliders', 'pageTitle'));
  }
  public function search(Request $request)
  {
    $search = $request->get('search');
    $sliders = Slider::where('text','like', '%' . $search . '%')
    ->orderBy('id')
    ->paginate(10);
    $pageTitle = 'Manage Slider';
    return view('admin.slider.index', compact('sliders', 'pageTitle','search'));
  }
  
   public function create(){
    $pageTitle='Add Slider';
    return view('admin.slider.create',compact('pageTitle'));
   }
  
   public function store(Request $request){

      $request->validate([
        'text' => 'required',
        'image' => 'required|dimensions:width=2000,height=570',
      ],
      [
        'text.required' => 'Text field is required!',
        'image.required' => 'Image field is required!',
        'image.dimensions' => 'Image dimensions should be 2000x570!',
        ]
      
      ); 
      
      $image = $request->file('image');

      $name = $image->getClientOriginalName();

      $destinationPath = public_path('admin-assets/images');
      $alreadyExist = public_path('admin-assets/images/'.$name);

      $image->move($destinationPath, $name);
      $image = $name;

      
      $sliders = new Slider;
      $sliders->text = $request['text'];
      $sliders->image= $image;
      $sliders->save();
      
      return redirect()->route('slider')->with('success', 'Slider content added successfully');
 
  }
  
  public function edit($id)
  {
   $pageTitle = 'Edit slider';
   $sliders = Slider::find($id);
   return view('admin.slider.edit', compact('pageTitle', 'sliders'));
  }
  
  public function update(Request $request, $id)
  {
        $request->validate([
          'text' => 'required',
            // 'image' => 'dimensions:width=2000,height=570',
            'image' => 'required'
          ],
          [
          'text.required' => 'Text field is required!',
            'image.required' => 'Image dimensions should be 2000x570!',
          ]
        );

      $sliders = Slider::find($id);
      if($request->hasFile('image')){
        $alreadyExist = public_path('admin-assets/images/'.$sliders->image);
        if(file_exists($alreadyExist)){
          unlink($alreadyExist);
        }

        // save new image
        $image = $request->file('image');
        $name = $image->getClientOriginalName();
        $destinationPath = public_path('admin-assets/images');
        $image->move($destinationPath, $name);
        $image = $name;
      }else{
        $image = $sliders->image;
      }

      $sliders->text = $request['text'];
      $sliders->image= $image;
      $sliders->save();
      dd("here");
      return redirect()->route('slider')->with('success', 'Slider content updated successfully');
  }
  
  public function delete($id){
    Slider::find($id)->delete();            
    return redirect()->back()->with('success', 'Slider content deleted successfully');  
  }
  
}
