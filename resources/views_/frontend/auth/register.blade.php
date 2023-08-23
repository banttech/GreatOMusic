<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Great “O” Music - Signup </title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend-assets/image/favicon/favicon.ico')}}" />
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

    <style>
        .pink {
            color: #CC0066 !important;
        }
        .pink:hover {
            color: #CC0066;
            border-bottom: 1px solid #CC0066;
        }
        .message_div p {
            margin-bottom: 3px;
        }
        
        @media (max-width: 1024px) {
            #captchadesign {
                -ms-flex: 0 0 50%;
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
        
    </style>
<body>


    <div class="authentication-inner signupbgimg signupdiv">
        <div class="card">
            <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center text-center">
                    <a href="{{route('index')}}" class="app-brand-link gap-2">
                        <img src="{{asset('frontend-assets/image/logosignup.png')}}" class="logologin" alt="" width="179px" height="22px" />
                    </a>
                </div>
                <!-- /Logo -->
                <h4 class="mb-3">Account Sign Up</h4>
                <form class="mb-2" method="POST" action="{{route('register')}}" onsubmit="return checkForm();">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name<span class="text-danger" style="font-size: 16px;">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter your name" value="{{ old('name') }}"
                                    autofocus />
                                <span class="text-danger error-text" id="nameError"></span>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email<span class="text-danger" style="font-size: 16px;">*</span></label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" value="{{ old('email') }}"
                                    autofocus />
                                <span class="text-danger error-text" id="emailError"></span>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="mb-3">
                                <label class="form-label" for="password">Password<span class="text-danger" style="font-size: 16px;">*</span></label>
                                <div class="input-group input-group-merge hovereye">
                                    <input type="password" id="password" class="form-control password" name="password"
                                        placeholder="············" aria-describedby="password" value="{{ old('password') }}">
                                    <span class="input-group-text cursor-pointer eyeicon show_hide_password" style="cursor: pointer;"><i class="fa fa-eye-slash icon_class"></i></span>
                                </div>
                                <span class="text-danger error-text" id="passwordError"></span>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="mb-3">
                                <label for="company" class="form-label">Company Name<span class="text-danger" style="font-size: 16px;">*</span></label>
                                <input type="text" class="form-control" id="company" name="company"
                                    placeholder="Enter your company name" value="{{ old('company') }}"
                                    autofocus />
                                <span class="text-danger error-text" id="companyError"></span>
                                @error('company')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="mb-3">
                                <label for="position" class="form-label">Position<span class="text-danger" style="font-size: 16px;">*</span></label>
                                <input type="text" class="form-control" id="position" name="position"
                                    placeholder="Enter your position" value="{{ old('position') }}"
                                    autofocus />
                                <span class="text-danger error-text" id="positionError"></span>
                                @error('position')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number<span class="text-danger" style="font-size: 16px;">*</span></label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="Enter your phone number" value="{{ old('phone') }}"
                                    autofocus />
                                <span class="text-danger error-text" id="phoneError"></span>
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="mb-3">
                                <label for="city" class="form-label">CITY<span class="text-danger" style="font-size: 16px;">*</span></label>
                                <input type="text" class="form-control" id="city" name="city"
                                    placeholder="Enter your city" value="{{ old('city') }}"
                                    autofocus />
                                <span class="text-danger error-text" id="cityError"></span>
                                @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="mb-3">
                                <label for="state" class="form-label">STATE<span class="text-danger" style="font-size: 16px;">*</span></label>
                                <select class="form-control" name="state" id="state">
                                    <option value="" selected disabled>Select Your State</option>
                                    @foreach($states as $key => $state)
                                        <option value="{{$state->code}}" {{ old('state') == $state->name ? 'selected' : '' }}>{{$state->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text" id="stateError"></span>
                                @error('state')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="mb-3">
                                <label for="country" class="form-label">COUNTRY<span class="text-danger" style="font-size: 16px;">*</span></label>
                                <select class="form-control" name="country" id="country">
                                    <option value="" selected disabled>Select Your Country</option>
                                    @foreach($countries as $key => $countries)
                                        <option value="{{$countries->code}}" @if(old('country') == $countries->name) selected @endif>{{$countries->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text" id="countryError"></span>
                                @error('country')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Website<span class="text-danger" style="font-size: 16px;">*</span></label>
                                <input type="text" class="form-control" id="website" name="website"
                                    placeholder="Enter your website" value="{{ old('website') }}"
                                    autofocus />
                                <span class="text-danger error-text" id="websiteError"></span>
                                @error('website')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                            <div class="mb-2">
                                <label for="here_about_us" class="form-label">How Did You Hear About Us?<span class="text-danger" style="font-size: 16px;">*</span></label>
                                <input type="text" class="form-control" id="about_us" name="here_about_us"
                                    placeholder="How did you hear about us?" value="{{ old('here_about_us') }}"
                                    autofocus />
                                <span class="text-danger error-text" id="aboutUsError"></span>
                                @error('here_about_us')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="mt-2 mb-1">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="terms-conditions"
                                                name="terms_conditions">
                                            <label class="form-check-label" for="terms-conditions">
                                                I have read and agree to the
                                                <a href="{{ route('frontend.terms') }}" target="_blank" class="pink">terms</a>.<span class="text-danger" style="font-size: 16px;">*</span>
                                            </label>
                                        </div>
                                        <span class="text-danger error-text" id="termsConditionsError"></span>
                                        @error('terms_conditions')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="join-email-list" name="joinEmailList">
                                            <label class="form-check-label" for="join-email-list">
                                                Subscribe to our email list.
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12" id="captchadesign">
                                    <div id="html_element">
                                        <div style="width: 304px; height: 78px;">
                                            <div>
                                                <div class="g-recaptcha" data-sitekey="6LfV_50mAAAAAKoTGh_GUAOkP-iaZmuHnICh6F_L"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-danger error-text" id="recaptchaError"></span>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button class="btn" type="submit" style="background:#CC0066;color:white;border-radius:20px;padding:4px 20px 7px 20px; margin-top:2px; border: none;">Sign Up</button>
                            </div>
                            <div class="signupdiv forgotpassword message_div">
                                <p>Already have an account ? Please <a href="{{ route('frontend.login') }}" class="pink">Login</a></p>
                                <p>Please click <a href="{{route('index')}}" class="pink">here</a> to visit the homepage.</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

        function checkForm(form)
        {

            // get values of required fields if empty then show error
            var name = document.getElementById('name').value;
            // return false;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var company = document.getElementById('company').value;
            var position = document.getElementById('position').value;
            var phone = document.getElementById('phone').value;
            var city = document.getElementById('city').value;
            var state = document.getElementById('state').value;
            var country = document.getElementById('country').value;
            var website = document.getElementById('website').value;
            var about_us = document.getElementById('about_us').value;
            var terms_conditions = document.getElementById('terms-conditions').checked;

            if (name == '' || email == '' || password == '' || company == '' || position == '' || phone == '' || city == '' || state == '' || country == '' || website == '' || about_us == '' ||!terms_conditions) {
                if (name == '') {
                    document.getElementById('nameError').innerHTML = '<span style="color: rgb(204, 0, 102); font-size: 14px; font-weight: 500;">Name field is required</span>';
                } else {
                    document.getElementById('nameError').innerHTML = '';
                }

                if (email == '') {
                    document.getElementById('emailError').innerHTML = '<span style="color: rgb(204, 0, 102); font-size: 14px; font-weight: 500;">Email field is required</span>';
                } else {
                    document.getElementById('emailError').innerHTML = '';
                }
                
                if (email != '') {
                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    if (!emailReg.test(email)) {
                        document.getElementById('emailError').innerHTML = '<span style="color: rgb(204, 0, 102); font-size: 14px; font-weight: 500;">Email is invalid</span>';
                    } else {
                        document.getElementById('emailError').innerHTML = '';
                    }
                }

                if (password == '') {
                    document.getElementById('passwordError').innerHTML = '<span style="color: rgb(204, 0, 102); font-size: 14px; font-weight: 500;">Password field is required</span>';
                } else {
                    document.getElementById('passwordError').innerHTML = '';
                }

                if (company == '') {
                    document.getElementById('companyError').innerHTML = '<span style="color: rgb(204, 0, 102); font-size: 14px; font-weight: 500;">Company Name field is required</span>';
                } else {
                    document.getElementById('companyError').innerHTML = '';
                }

                if (position == '') {
                    document.getElementById('positionError').innerHTML = '<span style="color: rgb(204, 0, 102); font-size: 14px; font-weight: 500;">Position field is required</span>';
                } else {
                    document.getElementById('positionError').innerHTML = '';
                }

                if (phone == '') {
                    document.getElementById('phoneError').innerHTML = '<span style="color: rgb(204, 0, 102); font-size: 14px; font-weight: 500;">Phone Number field is required</span>';
                } else {
                    document.getElementById('phoneError').innerHTML = '';
                }

                if (city == '') {
                    document.getElementById('cityError').innerHTML = '<span style="color: rgb(204, 0, 102); font-size: 14px; font-weight: 500;">City field is required</span>';
                } else {
                    document.getElementById('cityError').innerHTML = '';
                }

                if (state == '') {
                    document.getElementById('stateError').innerHTML = '<span style="color: rgb(204, 0, 102); font-size: 14px; font-weight: 500;">State field is required</span>';
                } else {
                    document.getElementById('stateError').innerHTML = '';
                }

                if (country == '') {
                    document.getElementById('countryError').innerHTML = '<span style="color: rgb(204, 0, 102); font-size: 14px; font-weight: 500;">Country field is required</span>';
                } else {
                    document.getElementById('countryError').innerHTML = '';
                }

                if (website == '') {
                    document.getElementById('websiteError').innerHTML = '<span style="color: rgb(204, 0, 102); font-size: 14px; font-weight: 500;">Website field is required</span>';
                } else {
                    document.getElementById('websiteError').innerHTML = '';
                }

                if (about_us == '') {
                    document.getElementById('aboutUsError').innerHTML = '<span style="color: rgb(204, 0, 102); font-size: 14px; font-weight: 500;">How did you hear about us? is required</span>';
                } else {
                    document.getElementById('aboutUsError').innerHTML = '';
                }

                if (!terms_conditions) {
                    document.getElementById('termsConditionsError').innerHTML = '<span style="color: rgb(204, 0, 102); font-size: 14px; font-weight: 500;">Terms and Condition is required</span>';
                } else {
                    document.getElementById('termsConditionsError').innerHTML = '';
                }
                return false;
            }

            // empty the error message
            document.getElementById('nameError').innerHTML = '';
            document.getElementById('emailError').innerHTML = '';
            document.getElementById('passwordError').innerHTML = '';
            document.getElementById('companyError').innerHTML = '';
            document.getElementById('positionError').innerHTML = '';
            document.getElementById('phoneError').innerHTML = '';
            document.getElementById('cityError').innerHTML = '';
            document.getElementById('stateError').innerHTML = '';
            document.getElementById('countryError').innerHTML = '';
            document.getElementById('websiteError').innerHTML = '';
            document.getElementById('aboutUsError').innerHTML = '';
            document.getElementById('termsConditionsError').innerHTML = '';

            if (grecaptcha.getResponse() == '')
            {
                document.getElementById('recaptchaError').innerHTML = '<span style="color: rgb(204, 0, 102); font-size: 15px; font-weight: 500;">Incorrect response. Please try again.</span>';
                return false;
            }
            else
            {
                document.getElementById('recaptchaError').innerHTML = '';
                return true;
            }
        }
    </script>

</body>

</html>
