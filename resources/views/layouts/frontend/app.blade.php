<?php
$homeContent = App\Models\PagesHome::first();
$login = App\Models\Login::first();
$facebook = App\Models\Social::where('name', 'facebook')->first()->user_id;
$twitter = App\Models\Social::where('name', 'twitter')->first()->user_id;
$youtube = App\Models\Social::where('name', 'youtube')->first()->user_id;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? 'Great “O” Music - Page Not Found' }}</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend-assets/image/favicon/favicon.ico')}}" />
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/style.css')}}">

    <link rel="stylesheet" href="{{ asset('frontend-assets/css/bootstrap.min.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.13/mediaelementplayer.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- <link rel="stylesheet" href="{{ asset('frontend-assets/css/font-awesome.min.css')}}"> -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="{{ asset('frontend-assets/js/style.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <!-- toastr css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        .active_link {
            color: #CC0066 !important;
            border-bottom: 2px solid #CC0066 !important;
        }

        .navbar {
            padding-left: 60px;
        }

        .cart__area {
            cursor: pointer;
            color: #CC0066 !important;
            font-weight: normal !important;
        }

        .cart__area:hover {
            color: #fff !important;
        }

        .cart__area .count {
            margin-right: 2px;
        }

        .music-search-link {
            width: 135px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-black">
            <a href="{{route('index')}}">
                <img src="{{ $login ? asset('admin-assets/images/'.$login->logo) : asset('frontend-assets/image/logo.png')}}" alt="" style="width: 200px;margin-left: 2%;">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item active">
                        <a class="nav-link{{ request()->is('/') ? ' active_link' : '' }}" href="{{route('index')}}">HOME <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ request()->is('about') ? ' active_link' : '' }}" href="{{route('frontend.about')}}">ABOUT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ request()->is('music-search') ? ' active_link' : '' }} music-search-link" href="{{route('frontend.music.search')}}"> <span> MUSIC SEARCH</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ request()->is('licensing') ? ' active_link' : '' }}" href="{{route('frontend.licensing')}}">LICENSING</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ request()->is('contact') ? ' active_link' : '' }}" href="{{route('frontend.contact')}}">CONTACT</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0 text-white pr-5">
                    @if(Auth::check())
                    <?php
                    $cart = App\Models\Cart::where(['user_id' => Auth::user()->id, 'status' => 1])->get();
                    $cartCount = count($cart);
                    ?>
                    [<a href="{{ route('frontend.cart') }}" class="cart__area"><span class="count">{{$cartCount}}</span><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>]
                    <a href="{{route('frontend.account')}}">Account</a> &nbsp;
                    <a href="{{route('frontend.logout')}}"><input type="button" class="btn " class="form-control" value="Logout" style="background:#CC0066;color:white;border-radius:20px;padding:4px 20px 7px 20px; margin-top:2px;"></a>
                    @else
                    <a href="{{route('frontend.login')}}">Login</a> &nbsp;
                    <a href="{{route('register')}}"><input type="button" class="btn " class="form-control" value="Sign Up" style="background:#CC0066;color:white;border-radius:20px;padding:4px 20px 7px 20px; margin-top:2px;"></a>
                    @endif
                </form>
            </div>
        </nav>
    </header>
    @yield('slider')

    @yield('content')
    <footer class="footer-section">
        <div class="container">
            <div class="footer-content pt-2 pb-0">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 mb-50">
                        <div class="footer-widget">
                            <div class="footer-logo">
                                <a href="https://greatomusic.com/"> <img src="{{ asset('admin-assets/images/logo.png')}}" alt="" style="width: 200%;height: 20%;"></a>
                            </div>
                            <div class="footer-text">
                                <p>
                                    {!! $homeContent->text !!}
                                </p>
                            </div>
                            <div class="footer-social-icon">
                                <span>Follow us</span>
                                <a href="{{$facebook ? $facebook : '#'}}" target="_blank">
                                    <img src="{{ asset('frontend-assets/image/facebook.webp')}}" alt="" width="20px" height="20px">
                                </a>
                                <a href="{{$twitter ? $twitter : '#'}}" target="_blank">
                                    <img src="{{ asset('frontend-assets/image/twitter.png')}}" alt="" width="20px" height="20px">
                                </a>
                                <a href="{{$youtube ? $youtube : '#'}}" target="_blank">
                                    <img src="{{ asset('frontend-assets/image/youtube.png')}}" alt="" width="25px" height="28px">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3>Useful Links</h3>
                            </div>
                            <ul>
                                <li><a href="{{route('index')}}">Home</a></li>
                                <li><a href="{{route('frontend.about')}}">About</a></li>
                                <li><a href="{{route('frontend.music.search')}}"> Music Search </a></li>
                                <li><a href="{{route('frontend.licensing')}}">Licensing</a></li>
                                <li><a href="{{route('frontend.contact')}}">Contact </a></li>
                                <li><a href="{{route('frontend.terms')}}">Terms </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-50">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3>Newsletter</h3>
                            </div>
                            <div class="footer-text mb-25">
                                <h3 style="color: #7e7e7e;">{{$homeContent->news_heading}}</h3>
                                <p>{{$homeContent->news_sub_heading}}</p>
                            </div>
                            <div class="subscribe-form">
                                <form action="#">
                                    <input type="text" placeholder="Email Address" id="subscriber_email_footer">
                                    <button type="button" id="subscribe_btn_footer"><img src="{{ asset('frontend-assets/image/newspaper.png')}}" alt="" width="40px;" height="40px;"></button>
                                </form>
                            </div>
                            <div class="alert alert-danger alert-dismissible fade show error_msg_alert_footer" role="alert" style="width: fit-content;margin: 0 auto;margin-top: 10px; display: none;">
                                <strong id="error_msg_footer"></strong>
                                <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer>


    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 m-auto text-center ">
                    <div class="copyright-text">
                        <p>Copyright &copy; 2023 Great "O" Music. All Rights Reserved. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <!-- Script to handle NewsLetter Subscriber -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle the close button click
            var closeButton = document.querySelector('.error_msg_alert_footer .close');
            closeButton.addEventListener('click', function() {
                var errorMsgAlert = document.querySelector('.error_msg_alert_footer');
                errorMsgAlert.style.display = 'none';
            });

            var subscribeBtn = document.getElementById('subscribe_btn_footer');
            subscribeBtn.addEventListener('click', function() {
                var subscriber_email = document.getElementById('subscriber_email_footer').value;
                subscribeBtn.disabled = true;
                if (subscriber_email == '') {
                    var errorMsgAlert = document.querySelector('.error_msg_alert_footer');
                    errorMsgAlert.style.display = 'block';
                    var errorMsg = document.getElementById('error_msg_footer');
                    errorMsg.innerHTML = 'Please enter your email address.';
                    subscribeBtn.disabled = false;
                } else {
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', "{{ route('subscriber.store') }}", true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-TOKEN', "{{ csrf_token() }}");
                    xhr.onload = function() {
                        if (xhr.status >= 200 && xhr.status < 400) {
                            var response = JSON.parse(xhr.responseText);
                            var errorMsgAlert = document.querySelector('.error_msg_alert_footer');
                            var errorMsg = document.getElementById('error_msg_footer');
                            if (response.errors) {
                                errorMsgAlert.style.display = 'block';
                                errorMsg.innerHTML = response.errors.email;
                            } else {
                                errorMsgAlert.style.display = 'block';
                                errorMsg.innerHTML = response.message;
                            }
                            subscribeBtn.disabled = false;
                        }
                    };
                    xhr.send("email=" + encodeURIComponent(subscriber_email));
                }
            });
        });
    </script>
</body>

</html>
