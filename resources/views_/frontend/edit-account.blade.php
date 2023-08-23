@extends('layouts.frontend.app')
@section('content')
    <style>
        .first_sec {
            height: 105px;
        }
        .about_section {
            background: url("{{ asset('admin-assets/images/account-bg.jpg') }}");
            min-height: 300px;
            object-fit: cover;
            background-size: 100%;
        }
        .width {
            width: 100%;
            background: #fff;
            padding: 10px 20px 10px 20px;
            margin: 60px 0px;
        }
        .edit_div {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .edit_div h2 {
            font-size: 24px;
            font-weight: 700;
        }
        .edit_div .pink {
            color: #CC0066;
            font-size: 18px;
            font-weight: 700;
        }
        .edit_div .pink:hover {
            color: #CC0066;
            text-decoration: underline !important;
        }
        .box-1 h2{
            margin-left: -12px;
            font-size: 46px;
        }
        .mainbgsblack{
           border-bottom: 3px solid #CC0066;
           box-shadow: 0 7px 0 0px #000000;
        }
        .custom-input::placeholder {
            font-size: 14px;
        }
    </style>
    
    <div class="heading-section">
        <div class="" id="set">
            <div class="m-0">
                <div class="d-flex align-items-end about_section">
                    <div class="mainbgsblack" style="background-color: rgba(0, 0, 0, 0.8);width: 100%;">
                        <div class="container">
                            <div class="box-1 w-100">
                                <h2>Account</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="about-inbox first_sec">
        <div class="container">
            <div class="row">
                <div class="width edit_div">
                    <h2>Edit Account</h2>
                    <a href="{{ route('frontend.account') }}" class="pink right">Account Details</a>
                </div>
            </div>
        </div>
    </section>

    <section class="about-inbox">
        <div class="container">
            <div class="row">
                @if(session()->has('success'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert" style="width: 100%; margin: 30px 0px -40px 0px;">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="width">
                    <form class="mb-2" method="POST" action="{{route('frontend.update.account')}}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name <span class="text-danger" style="font-size: 16px;">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter your name" value="{{ $user->name }}"
                                        autofocus />
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger" style="font-size: 16px;">*</span></label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Enter your email" value="{{ $user->email }}"
                                        autofocus />
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="password">Password <span class="text-danger" style="font-size: 16px;">*</span></label>
                                    <div class="input-group input-group-merge hovereye">
                                        <input type="password" id="password" class="form-control password custom-input" name="password"
                                            placeholder="Leave blank to remain unchanged" aria-describedby="password" value="">
                                        <span class="input-group-text cursor-pointer eyeicon show_hide_password" style="cursor: pointer;"><i class="fa fa-eye-slash icon_class"></i></span>
                                    </div>
                                    <!-- <p class=text-danger>Leave blank if you don't want to change.</p> -->
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="company" class="form-label">Company Name <span class="text-danger" style="font-size: 16px;">*</span></label>
                                    <input type="text" class="form-control" id="company" name="company"
                                        placeholder="Enter your company name" value="{{ $user->company }}"
                                        autofocus />
                                    @error('company')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="position" class="form-label">Position <span class="text-danger" style="font-size: 16px;">*</span></label>
                                    <input type="text" class="form-control" id="position" name="position"
                                        placeholder="Enter your position" value="{{ $user->position }}"
                                        autofocus />
                                    @error('position')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number <span class="text-danger" style="font-size: 16px;">*</span></label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Enter your phone number" value="{{ $user->phone }}"
                                        autofocus />
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="city" class="form-label">City <span class="text-danger" style="font-size: 16px;">*</span></label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        placeholder="Enter your city name" value="{{ $user->city }}"
                                        autofocus />
                                    @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="state" class="form-label">State <span class="text-danger" style="font-size: 16px;">*</span></label>
                                    <select class="form-control" name="state">
                                        <option value="" selected disabled>Select Your State</option>
                                        @foreach($states as $key => $state)
                                            <option value="{{$state->code}}" {{ $user->state == $state->code ? 'selected' : '' }}>{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                    </select>
                                    @error('state')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="country" class="form-label">Country <span class="text-danger" style="font-size: 16px;">*</span></label>
                                    <select class="form-control" name="country">
                                        <option value="" selected disabled>Select Your Country</option>
                                        @foreach($countries as $key => $country)
                                            <option value="{{$country->code}}" {{ $user->country == $country->code ? 'selected' : '' }}>{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Website <span class="text-danger" style="font-size: 16px;">*</span></label>
                                    <input type="text" class="form-control" id="website" name="website"
                                        placeholder="Enter your website" value="{{ $user->website }}"
                                        autofocus />
                                    @error('website')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                                <div class="mb-2">
                                    <label for="here_about_us" class="form-label">How Did You Hear About Us? <span class="text-danger" style="font-size: 16px;">*</span></label>
                                    <input type="text" class="form-control" id="about_us" name="here_about_us"
                                        placeholder="How Did You Hear About Us?" value="{{ $user->referred_by }}"
                                        autofocus />
                                    @error('here_about_us')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="mt-3">
                                    <button class="btn" type="submit" style="background:#CC0066;color:white;border-radius:20px;padding:4px 20px 7px 20px; margin-top:2px; border: none;">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        const togglePassword = document.querySelector('.show_hide_password');
        const password = document.querySelector('.password');
        const icon = document.querySelector('.icon_class');
        togglePassword.addEventListener('click', function (e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // check if icons is eye or eye slash then toogle icon
            const iconClass = icon.classList.contains('fa-eye-slash') ? 'fa-eye' : 'fa-eye-slash';
            // check if fa-eye-slash is already in classList then remove it else add it
            icon.classList.remove(iconClass === 'fa-eye-slash' ? 'fa-eye' : 'fa-eye-slash');
            icon.classList.add(iconClass);
        });
    </script>
@endsection