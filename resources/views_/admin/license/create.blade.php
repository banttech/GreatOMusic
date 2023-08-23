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
                <h5 class="mb-0">Add New License</h5>
               
              </div>
              <div class="card-body">
                <form action="{{ route('license.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Name<span class="text-danger" style="font-size: 16px;">*</span></label>
                    <div class="col-sm-10">
                      <input type="text" name="name" class="form-control" id="basic-default-name" placeholder="Enter license Name" value="{{ old('name') }}" required />
                    </div>
                    @error('name')
                    <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
                     @enderror
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-2 form-label" for="basic-icon-default-message">Text<span class="text-danger" style="font-size: 16px;">*</span></label>
                    <div class="col-sm-10">
                      <div class="input-group input-group-merge">
                        <span id="basic-icon-default-message2" class="input-group-text"style="border:none!important;"
                          ></span>
                        <textarea
                          id="basic-icon-default-message"
                          name="text"
                          class="form-control"
                          placeholder=""
                          required
                          rows="10" cols=""
                        >
                        {{ old('text') }}
                      </textarea>
                      </div>
                    </div>
                    @error('text')
                    <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
                     @enderror
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Territory<span class="text-danger" style="font-size: 16px;">*</span></label>
                    <div class="col-sm-10">
                      <select id="largeSelect" class="form-select form-select-lg" name="territory">
                      @foreach($territorys as $key => $territory)
                          <option value="{{ $territory->name }}" {{ old('territory') == $territory->name ? 'selected' : '' }}>
                              {{ $territory->name }}
                          </option>
                      @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Term<span class="text-danger" style="font-size: 16px;">*</span></label>
                    <div class="col-sm-10">
                      <select id="largeSelect" class="form-select form-select-lg" name="term">
                        @foreach($terms as $key => $term)
                        <option value="{{$term->name}}" {{ old('term') == $term->name ? 'selected' : '' }}>
                          {{$term->name}}
                        </option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Price<span class="text-danger" style="font-size: 16px;">*</span></label>
                    <div class="col-sm-10">
                      <input type="text" name="price" class="form-control" id="basic-default-name" placeholder="Enter price" value="{{ old('price') }}" required />
                    </div>
                    @error('price')
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
      <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
      <script>
        CKEDITOR.replace('text');
        CKEDITOR.config.width = 1250  
        CKEDITOR.config.height = 300
    </script>
  @endsection