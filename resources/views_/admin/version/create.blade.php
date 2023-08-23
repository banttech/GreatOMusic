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
                <h5 class="mb-0">Add New Version</h5>
                
              </div>
              <div class="card-body">
                <form action="{{ route('version.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Name<span class="text-danger" style="font-size: 16px;">*</span></label>
                    <div class="col-sm-10">
                      <input type="text" name="name" class="form-control" id="basic-default-name" placeholder="Enter version Name" required/>
                    </div>
    
                    @error('name')
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