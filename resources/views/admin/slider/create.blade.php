@extends('layouts.admin.app')

@section('content')
     <!-- Content wrapper -->
     <div class="content-wrapper">
      <!-- Content -->

      <div class="container-xxl flex-grow-1 container-p-y">
       <!-- Basic Layout & Basic with Icons -->
        <div class="row">
          <!-- Basic Layout -->
          <div class="col-xxl">
            <div class="card mb-4">
              <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Add New Slider</h5>
               
              </div>
              <div class="card-body">
                <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Text<span class="text-danger" style="font-size: 16px;">*</span></label>
                    <div class="col-sm-10">
                      <input type="text" name="text" class="form-control" id="basic-default-name" placeholder="Enter slider text" value="{{ old('text') }}" required />
                    </div>

                    @error('text')
                    <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
                     @enderror
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label " for="basic-default-name">Image<br>(2000 x 570 pixel)<span class="text-danger" style="font-size: 16px;">*</span></label>
                  <div class="col-sm-10">
                    {{-- <img class="mt-2" src="{{ url('admin-assets/images/'. $pagesterms->header_image)}}" alt=" "
                     width="200px" height="200px" id="header_img" /> <br><br> --}}
                    <input type="file" name="image"  class="form-control mb-2" required/>
                    <h6 class="allowed_type text-danger" style="font-size:12px;" >Only JPG, JPEG and PNG extensions are allowed.</p>
                    {{-- <p class="allowed_type text-primary">Image size can't exceeds the size 1800px X 1800px.</p> --}}
                
                  </div>
                  @error('image')
                  <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
                   @enderror
                  </div>
                  <div class="row justify-content-">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          
        </div>
      </div>
  
  @endsection