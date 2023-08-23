@extends('layouts.admin.app')

@section('content')

    <style>
        .music_text {
            margin: 0px;
            padding: 7px;
            background: #CCCCCC;
            border-radius: 2px;
            color: #000 !important;
        }
    </style>

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
                <h5 class="mb-0">{{$pageTitle}}</h5>
               
              </div>
              <div class="card-body">
                <form action="{{ route('user.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row mb-3">
                    <label class="col-sm-1 col-form-label" for="basic-default-name">Name</label>
                    <div class="col-sm-11">
                      <input type="text" name="name" class="form-control" id="basic-default-name" placeholder="Enter name" value="{{ $user->name }}" required />
                    </div>
                    @error('name')
                    <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
                     @enderror
                  </div>

                    <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="basic-default-name">Email</label>
                        <div class="col-sm-11">
                        <input type="text" name="email" class="form-control" id="basic-default-name" placeholder="Enter email" value="{{ $user->email }}" required />
                        </div>
                        @error('email')
                        <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
                         @enderror
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="basic-default-name">Phone</label>
                        <div class="col-sm-11">
                        <input type="text" name="phone" class="form-control" id="basic-default-name" placeholder="Enter phone" value="{{ $user->phone }}" required />
                        </div>
                        @error('phone')
                        <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
                         @enderror
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="basic-default-name">Password</label>
                        <div class="col-sm-11">
                            <input type="password" name="password" class="form-control" id="basic-default-name" placeholder="Enter password" value="" />
                            <p class="text-danger">leave blank if you don't want to change password</p>
                        </div>
                        @error('password')
                        <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
                         @enderror
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="basic-default-name">Company</label>
                        <div class="col-sm-11">
                        <input type="text" name="company" class="form-control" id="basic-default-name" placeholder="Enter company" value="{{ $user->company }}" required />
                        </div>
                        @error('company')
                        <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
                         @enderror
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="basic-default-name">Position</label>
                        <div class="col-sm-11">
                        <input type="text" name="position" class="form-control" id="basic-default-name" placeholder="Enter position" value="{{ $user->position }}" required />
                        </div>
                        @error('position')
                        <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
                         @enderror
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="basic-default-name">City</label>
                        <div class="col-sm-11">
                        <input type="text" name="city" class="form-control" id="basic-default-name" placeholder="Enter city" value="{{ $user->city }}" required />
                        </div>
                        @error('city')
                        <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
                         @enderror
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="basic-default-name">State</label>
                        <div class="col-sm-11">
                        <input type="text" name="state" class="form-control" id="basic-default-name" placeholder="Enter state" value="{{ $user->state }}" required />
                        </div>
                        @error('state')
                        <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
                         @enderror
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="basic-default-name">Country</label>
                        <div class="col-sm-11">
                        <input type="text" name="country" class="form-control" id="basic-default-name" placeholder="Enter country" value="{{ $user->country }}" required />
                        </div>
                        @error('country')
                        <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
                         @enderror
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="basic-default-name">Website</label>
                        <div class="col-sm-11">
                        <input type="text" name="website" class="form-control" id="basic-default-name" placeholder="Enter website" value="{{ $user->website }}" required />
                        </div>
                        @error('website')
                        <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
                         @enderror
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="basic-default-name">Referred By</label>
                        <div class="col-sm-11">
                        <input type="text" name="referred_by" class="form-control" id="basic-default-name" placeholder="Enter referred_by" value="{{ $user->referred_by }}" required />
                        </div>
                        @error('referred_by')
                        <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
                         @enderror
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="basic-default-name">Join Email List</label>
                        <div class="col-sm-11">
                            <input type="radio" name="joinEmailList" value="1" {{ $user->joinEmailList == '1' ? 'checked' : ''}}> Yes
                            <input type="radio" name="joinEmailList" value="0" {{ $user->joinEmailList == '0' ? 'checked' : ''}}> No
                        </div>
                        @error('joinEmailList')
                        <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
                         @enderror
                    </div>
                    
                    <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="basic-default-name">Date</label>
                        <div class="col-sm-11">
                            <p>
                                {{ date('m/d/Y - h:i:s A', strtotime($user->date)) }}
                            </p>
                        </div>
                    </div>

                  <div class="row justify-content-">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </div>

                </form>
              </div>
            </div>
          </div>
          
        </div>
      </div>
  @endsection