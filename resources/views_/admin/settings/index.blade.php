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
              <div class="card-header">
                <h5 class="mb-0">Update Logo</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Image<br>(200 x 25 pixel)</label>
                        <div class="col-sm-10">
                            <img class="mt-2 mb-2" style="background-color:#CC0066" src="{{ $login ? url('admin-assets/images/'. $login->logo) : url('')}}" alt=" "
                            width="100%" height="200px" id="logo" /> <br>
                            <input type="file" name="logo"  class="form-control mb-2" value="{{$login ? $login->logo : '' }}" />
                            <h6 style="font-size:12px;" class="text-danger">Only JPG, JPEG and PNG extensions are allowed.</h6>
                        </div>
                        @error('logo')
                            <div class="text-danger offset-sm-2 col-sm-10">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row justify-content-">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary mb-3">Update</button>
                    </div>
                  </div>
                </form>
                <hr size="4px" width="100%">

                <form action="{{ route('settings.social-media.update') }}" method="POST">
                    @csrf
                    <h5 class="mb-0">Social Media</h5>
                    <hr size="4px" width="100%">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Facebook</label>
                        <div class="col-sm-10 mb-2">
                            <input type="text" name="facebook" class="form-control" value="{{ old('facebook') ? old('facebook') : ($facebook ? $facebook : '') }}"/>
                        </div>
                        @error('facebook')
                            <div class="text-danger offset-sm-2 col-sm-10">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Twitter</label>
                        <div class="col-sm-10 mb-2">
                            <input type="text" name="twitter" class="form-control" value="{{ old('twitter') ? old('twitter') : ($twitter ? $twitter : '') }}"/>
                        </div>
                        @error('twitter')
                            <div class="text-danger offset-sm-2 col-sm-10">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-5">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Youtube</label>
                        <div class="col-sm-10 mb-2">
                            <input type="text" name="youtube" class="form-control" value="{{ old('youtube') ? old('youtube') : ($youtube ? $youtube : '') }}"/>
                        </div>
                        @error('youtube')
                            <div class="text-danger offset-sm-2 col-sm-10">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary mb-3">Update</button>
                    </div>
                </form>
                <hr size="4px" width="100%">

                <form action="{{ route('settings.mailing-address.update') }}" method="POST">
                    @csrf
                    <h5 class="mb-0">Email Address</h5>
                    <hr size="4px" width="100%">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Sending Mail</label>
                        <div class="col-sm-10 mb-2">
                            <input type="text" name="send_mail" class="form-control" value="{{ old('send_mail') ? old('send_mail') : ($contactUs->send_mail ? $contactUs->send_mail : '') }}"/>
                        </div>
                        @error('send_mail')
                            <div class="text-danger offset-sm-2 col-sm-10">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Receiving Mail</label>
                        <div class="col-sm-10">
                            <input type="text" name="receive_mail" class="form-control" value="{{ old('receive_mail') ? old('receive_mail') : ($contactUs->receive_mail ? $contactUs->receive_mail : '') }}"/>
                        </div>
                        @error('receive_mail')
                            <div class="text-danger offset-sm-2 col-sm-10">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
      <script>
    // for image 1
        const logoImg = document.getElementById('logo');
        const logoInput = document.querySelector('input[name="logo"]');
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
