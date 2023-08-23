@extends('layouts.admin.app')

@section('content')

     <!-- Content wrapper -->
     <div class="content-wrapper">
      <!-- Content -->

      <div class="container-xxl flex-grow-1 container-p-y">
       <!-- Basic Layout & Basic with Icons -->
        @include('layouts.partials.messages')
        <div class="row">
          <!-- Basic Layout -->
          <div class="col-xxl">
            <div class="card mb-4">
              <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Licensing</h5>
              
              </div>
              <div class="card-body">
                <form action="{{ route('licensing.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row mb-3">
                    <label class="col-sm-2 form-label footertxt" for="basic-icon-default-message">Text<span class="text-danger" style="font-size: 16px;">*</span></label>
                    <div class="col-sm-10">
                      <div class="input-group input-group-merge">
                        <span id="basic-icon-default-message2" class="input-group-text"style="border:none!important;"
                          ></span>
                        <textarea
                          id="basic-icon-default-message"
                          name="text"
                          class="form-control"
                          placeholder=""
                          rows="10" cols=""
                    >{{$pageslicensings->text}}</textarea>
                      </div>
                    </div>
                    @error('text')
                    <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
                     @enderror
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label " for="basic-default-name">Header Image<br>(1800 x 476 pixel)<span class="text-danger" style="font-size: 16px;">*</span></label>
                  <div class="col-sm-10">
                    <img class="mt-2 mb-2" src="{{ url('admin-assets/images/'.$pageslicensings->headerimg)}}" alt=" "
                     width="100%" height="200px" id="header_img" />
                    <input type="file" name="headerimg" value="{{$pageslicensings->headerimg}}" class="form-control mb-2"/>
                    <h6 class="text-danger" style="font-size:12px;" >Only JPG, JPEG and PNG extensions are allowed.</h6>
                    {{-- <h6 class="text-danger imgvalidationmsg">Image size can't exceeds the size 1800px X 1800px.</h6> --}}
                
                  </div>
                  @error('headerimg')
                  <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
                   @enderror
                  </div>
                  <div class="row justify-content-">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
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


        const logoImg = document.getElementById('header_img');
        const logoInput = document.querySelector('input[name="headerimg"]');
        logoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.addEventListener('load', function() {
                    logoImg.setAttribute('src', this.result);
                });
                reader.readAsDataURL(file);
            }
        });

      
    </script>
  @endsection