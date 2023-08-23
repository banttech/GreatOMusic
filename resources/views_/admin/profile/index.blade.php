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
                <h5 class="mb-0">Profile Settings</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- <div class="row mb-4">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Profile Image<br>(50 x 50 pixel)</label>
                        <div class="col-sm-10">
                            @if($user->image)
                                <img class="mt-2 mb-2" src="{{ $user ? url('admin-assets/images/'. $user->image) : url('')}}" alt=" " width="100px" height="100px" id="image" />
                            @else
                              <img class="mb-2" src="{{ asset('admin-assets/img/avatars/user.jpg')}}" alt=" " width="100%" height="200px" id="image" />
                            @endif
                             <br>
                            <input type="file" name="image"  class="form-control mb-2" value="{{$user ? $user->image : '' }}" />
                            <h6 style="font-size:12px;" class="text-danger">Only JPG, JPEG and PNG extensions are allowed.</h6>
                        </div>
                        @error('image')
                            <div class="text-danger offset-sm-2 col-sm-10">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="basic-default-name" value="{{ $user->name }}" />
                        </div>
                        @error('name')
                            <div class="text-danger offset-sm-2 col-sm-10">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Username</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" class="form-control" id="basic-default-name" value="{{ $user->username }}" />
                        </div>
                        @error('username')
                            <div class="text-danger offset-sm-2 col-sm-10">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Password</label>
                        <div class="col-sm-10">
                            <input type="text" name="password" class="form-control" id="basic-default-name" value="" />
                            <p class=text-danger>Leave blank if you don't want to change password.</p>
                        </div>
                        @error('password')
                            <div class="text-danger offset-sm-2 col-sm-10">{{ $message }}</div>
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
    // for image 1
        const logoImg = document.getElementById('image');
        const logoInput = document.querySelector('input[name="image"]');
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
