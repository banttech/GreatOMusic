<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Great "O" Music - Login </title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend-assets/image/favicon/favicon.ico')}}" />
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    </style>

<body>


    <div class="authentication-inner">
        <div class="card">
            <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center text-center">
                    <a href="{{route('index')}}" class="app-brand-link gap-2">
                        <img src="{{asset('frontend-assets/image/logologin.png')}}" class="logologin" alt="" />
                    </a>
                </div>
                <!-- /Logo -->
                <h4 class="mb-2">Account Login</h4>
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                    </div>
                @endif
                <?php
                    $file = request()->query('file');
                    $id = request()->query('id');
                    $cart_item = request()->query('cart_item');
                    $actionUrl = route('frontend.login');

                    if ($file && $cart_item == 0) {
                        $actionUrl .= '?id=' . urlencode($id) . '&file=' . urlencode($file) . '&cart_item=' . urlencode($cart_item);
                    }
                ?>
                <form class="mb-3" method="POST" action="{{ $actionUrl }}">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email<span class="text-danger" style="font-size: 16px;">*</span></label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" autofocus="">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 form-password-toggle forgotpassword">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">Password<span class="text-danger" style="font-size: 16px;">*</span></label>
                            <a href="{{ route('frontend.forgot') }}">
                                <small>Forgot Password?</small>
                            </a>
                        </div>
                        <div class="input-group input-group-merge hovereye">
                            <input type="password" id="password" class="form-control password" name="password"
                                placeholder="············" aria-describedby="password" value="{{ old('password') }}">
                            <span class="input-group-text cursor-pointer eyeicon show_hide_password" style="cursor: pointer;"><i class="fa fa-eye-slash icon_class"></i></span>
                        </div>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn" type="submit" style="background:#CC0066;color:white;border-radius:20px;padding:4px 20px 7px 20px; margin-top:2px; border: none;">Login</button>
                        <!-- <button class="btn btn-primary d-grid w-100" type="submit">Sign In</button> -->
                    </div>
                    <div class="signupdiv forgotpassword message_div">
                        <p>Don’t Have An Account ? Please <a href="{{ route('register') }}" class="pink">Sign Up</a></p>
                        <p>Please click <a href="{{route('index')}}" class="pink">here</a> to visit the homepage.</p>
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
    </script>
</body>

</html>
