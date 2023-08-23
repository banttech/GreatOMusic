@extends('layouts.frontend.app')
@section('content')
    <style>
        .contact_section {
            background: url("{{ asset('admin-assets/images/'.$contactContent->headerimg) }}");
            min-height: 300px;
            object-fit: cover;
            background-size: 100% 100%;
        }

        .subscribe_form{
            display: flex;
        }

        .unsubscribe_form{
            display: flex;
        }

        .subscribe_input {
            height: 40px;
        }

        .unsubscribe_input {
            height: 40px;
        }
        
        .btnsubmit {
            background: #CC0066 !important;
            color: #FFF !important;
            padding: 7px 25px !important;
            font-size: 18px;
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 600;
            border: 0px !important;
            margin-left: 5px !important;
        }

        .form-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .form-list li {
            margin-bottom: 10px;
        }

        .contact-form {
            width: 100%;
            background: #fff;
            padding: 50px 20px 50px 20px;
        }
        
        .contact-form-container {
            padding: 60px 0px;
        }
        .width {
            width: 100%;
            background: #fff;
            padding: 25px 20px 6px 20px;
            margin: 60px 0px;
        }
        .box-1 h2{
            margin-left: -12px;
            font-size: 46px;
        }
        .mainbgsblack{
           border-bottom: 3px solid #CC0066;
           box-shadow: 0 7px 0 0px #000000;
        }
        .bg-gray:hover {
            background-color: gray !important;
        }
        
        @media screen and (max-width: 768px) {
            .active_link {
                width: 80px;
            }
        }
        
    </style>

    <div class="heading-section">
        <div class="" id="set">
            <div class="m-0">
                <div class="d-flex align-items-end contact_section">
                    <div class="mainbgsblack" style="background-color: rgba(0, 0, 0, 0.8);width: 100%;">
                        <div class="container">
                            <div class="box-1 w-100">
                                <h2>Contact</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- 
    @if (session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif --}}


    <section class="about-inbox">
        <div class="container contact-form-container">
            <div class="row contact-form">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('contact.storeInformation') }}" onsubmit="return checkForm();">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @csrf
                        <div class="form-txt">
                            <h3><span>Please use the following form to contact us.</span></h3>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="name"
                                placeholder="Enter your name" name="name" value="{{ old('name') }}">
                            <span class="text-danger error-text" id="nameError"></span>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="email"
                                placeholder="Enter you email" name="email" value="{{ old('email') }}">
                            <span class="text-danger error-text" id="emailError"></span>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <select class="form-control question_dorpdown" name="reason" id="reason">
                                <option selected disabled>Questions</option>
                                <option class="bg-gray" value="Licensing" @if(old('reason') == 'Licensing') selected @endif>Licensing</option>
                                <option class="bg-gray" value="Sample Clearance" @if(old('reason') == 'Sample Clearance') selected @endif>Sample Clearance</option>
                                <option class="bg-gray" value="Advertising" @if(old('reason') == 'Advertising') selected @endif>Advertising</option>
                            </select>
                            <span class="text-danger error-text" id="reasonError"></span>
                            @if ($errors->has('reason'))
                                <span class="text-danger">{{ $errors->first('reason') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Enter your message" name="comments" rows="5" cols="30" id="message">{{ old('comments') }}</textarea>
                            <span class="text-danger error-text" id="messageError"></span>
                            @if ($errors->has('comments'))
                                <span class="text-danger">{{ $errors->first('comments') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div id="html_element">
                                <div style="width: 304px; height: 78px;">
                                    <div>
                                        <div class="g-recaptcha" data-sitekey="6LfV_50mAAAAAKoTGh_GUAOkP-iaZmuHnICh6F_L"></div>
                                    </div>
                                </div>
                            </div>
                            <span class="text-danger error-text" id="recaptchaError"></span>
                        </div>
                        <button type="submit" class="btn" style="background:#CC0066;color:white;border-radius:20px;padding:4px 20px 7px 20px; margin-top:2px;">Submit</button>
                        <!-- <button type="submit" class="btn btn-primary btnsubmit">Submit</button> -->
                    </form>
                </div>
                <!-- <div class="col-md-4 ">
                    <div class="form-txt">
                        <h3>Email List</h3>
                    </div>
                    <div class="row">
                        <div class="col pt-4">
                            <p><a style="color: #CC0066; cursor: pointer;" onclick="subscribeForm();">click here</a> to subscribe to our email list.</p>
                            <p><a style="color: #CC0066; cursor: pointer;" onclick="unSubscribeForm();">click here</a> to unsubscribe to our email list.</p>
                        </div>
                    </div>
                    <form id="subscribe" name="form1" method="post" style="display: none;">
                        <ul class="form-list">
                            <li class="">
                                <div class="subscribe_form">
                                    <input type="text" name="email" class="required email form-control subscribe_input" placeholder="Enter Your Email" id="subscriber_email" />
                                    <input type="button" name="submit1" value="Subscribe" class="btns btn-primary btnsubmit" id="subscribe_btn" />
                                </div> 
                                <div class="alert alert-danger alert-dismissible fade show error_msg_alert" role="alert" style="width: fit-content;margin: 0 auto;margin-top: 10px; display: none;">
                                    <strong id="error_msg"></strong>
                                    <button type="button" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </li>
                        </ul>
                    </form>

                    <form id="unsubscribe" name="form1" method="post" style="display: none;">
                        <ul class="form-list">
                            <li class="">
                                <div class="unsubscribe_form">
                                    <input type="text" name="email" class="required email form-control subscribe_input" placeholder="Enter Your Email" id="unsubscriber_email" />
                                    <input type="button" name="submit1" value="Unsubscribe" class="btns btn-primary btnsubmit" id="unsubscribe_btn" style="padding: 6px 14px !important; height: 42px;" />
                                </div>
                                <div class="alert alert-danger alert-dismissible fade show error_msg_alert unsub_error_alert" role="alert" style="width: fit-content;margin: 0 auto;margin-top: 10px; display: none;">
                                    <strong id="unsub_error_msg"></strong>
                                    <button type="button" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </li>
                        </ul>
                    </form>
                </div> -->
            </div>
        </div>
    </section>


    <script>
        function subscribeForm() {
            var subscribe = document.getElementById("subscribe");
            if (subscribe.style.display === "none") {
                subscribe.style.display = "block";
            } else {
                subscribe.style.display = "none";
            }
        }

        function unSubscribeForm() {
            var unsubscribe = document.getElementById("unsubscribe");
            if (unsubscribe.style.display === "none") {
                unsubscribe.style.display = "block";
            } else {
                unsubscribe.style.display = "none";
            }
        }

        // Handle the close button click
        var closeButton = document.querySelector('.error_msg_alert .close');
        closeButton.addEventListener('click', function() {
            var errorMsgAlert = document.querySelector('.error_msg_alert');
            errorMsgAlert.style.display = 'none';
        });

        var subscribeBtn = document.getElementById('subscribe_btn');
        subscribeBtn.addEventListener('click', function() {
            var subscriber_email = document.getElementById('subscriber_email').value;
            if(subscriber_email == ''){
                var errorMsgAlert = document.querySelector('.error_msg_alert');
                errorMsgAlert.style.display = 'block';
                var errorMsg = document.getElementById('error_msg');
                errorMsg.innerHTML = 'Please enter your email address.';
            }else{
                var xhr = new XMLHttpRequest();
                xhr.open('POST', "{{ route('subscriber.store') }}", true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-TOKEN', "{{ csrf_token() }}");
                xhr.onload = function() {
                    if (xhr.status >= 200 && xhr.status < 400) {
                        var response = JSON.parse(xhr.responseText);
                        var errorMsgAlert = document.querySelector('.error_msg_alert');
                        var errorMsg = document.getElementById('error_msg');
                        if (response.errors) {
                            errorMsgAlert.style.display = 'block';
                            errorMsg.innerHTML = response.errors.email;
                        } else {
                            errorMsgAlert.style.display = 'block';
                            errorMsg.innerHTML = response.message;
                        }
                    }
                };
                xhr.send("email=" + encodeURIComponent(subscriber_email));
            }
        });

        // Handle the unsub close button click
        var closeButton = document.querySelector('.unsub_error_alert .close');
        closeButton.addEventListener('click', function() {
            var errorMsgAlert = document.querySelector('.unsub_error_alert');
            errorMsgAlert.style.display = 'none';
        });

        var unsubscribeBtn = document.getElementById('unsubscribe_btn');
        unsubscribeBtn.addEventListener('click', function() {
            var unsubscriber_email = document.getElementById('unsubscriber_email').value;
            if(unsubscriber_email == ''){
                var errorMsgAlert = document.querySelector('.unsub_error_alert');
                errorMsgAlert.style.display = 'block';
                var errorMsg = document.getElementById('unsub_error_msg');
                errorMsg.innerHTML = 'Please enter your email address.';
            }else{
                var xhr = new XMLHttpRequest();
                xhr.open('POST', "{{ route('subscriber.destroy') }}", true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-TOKEN', "{{ csrf_token() }}");
                xhr.onload = function() {
                    if (xhr.status >= 200 && xhr.status < 400) {
                        var response = JSON.parse(xhr.responseText);
                        var errorMsgAlert = document.querySelector('.unsub_error_alert');
                        var errorMsg = document.getElementById('unsub_error_msg');
                        if (response.errors) {
                            errorMsgAlert.style.display = 'block';
                            errorMsg.innerHTML = response.errors.email;
                        } else {
                            errorMsgAlert.style.display = 'block';
                            errorMsg.innerHTML = response.message;
                        }
                    }
                };
                xhr.send("email=" + encodeURIComponent(unsubscriber_email));
            }
        });

        function checkForm()
        {
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var reason = document.getElementById('reason').value;
            var message = document.getElementById('message').value;

            if (name == '' || email == '' || message == '')
            {
                if(name == '') {
                    document.getElementById('nameError').innerHTML = '<span style="color: rgb(204, 0, 102); font-size: 15px; font-weight: 500;">Name is required</span>';
                } else {
                    document.getElementById('nameError').innerHTML = '';
                }
                if(email == '') {
                    document.getElementById('emailError').innerHTML = '<span style="color: rgb(204, 0, 102); font-size: 15px; font-weight: 500;">Email is required</span>';
                } else {
                    document.getElementById('emailError').innerHTML = '';
                }
                if(reason == '' || reason == 'Questions') {
                    document.getElementById('reasonError').innerHTML = '<span style="color: rgb(204, 0, 102); font-size: 15px; font-weight: 500;">Question is required</span>';
                } else {
                    document.getElementById('reasonError').innerHTML = '';
                }
                if(message == '') {
                    document.getElementById('messageError').innerHTML = '<span style="color: rgb(204, 0, 102); font-size: 15px; font-weight: 500;">Message is required</span>';
                } else {
                    document.getElementById('messageError').innerHTML = '';
                }
                return false;
            }

            // empty the error message
            document.getElementById('nameError').innerHTML = '';
            document.getElementById('emailError').innerHTML = '';
            document.getElementById('reasonError').innerHTML = '';
            document.getElementById('messageError').innerHTML = '';

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
@endsection