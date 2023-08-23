@extends('layouts.frontend.app')
@section('slider')

<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @if($sliders->count() > 0)
            @foreach($sliders as $key => $slider)
                <li data-target="#carouselExampleCaptions" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
            @endforeach
        @endif
    </ol>
    <div class="carousel-inner">
        @if($sliders->count() > 0)
            @foreach($sliders as $key => $slider)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ asset('admin-assets/images/'.$slider->image )}}" class="d-block w-100" alt="...">
                    <div class="slider">
                        <h1>{{ $slider->text }}</h1>
                    </div>
                </div>
            @endforeach
        @endif

        <!-- <div class="carousel-item active">
            <img src="{{ asset('frontend-assets/image/A1.jpg')}}" class="d-block w-100" alt="...">
            <div class="slider">
                <h1>The Greatest Music Available</h1>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('frontend-assets/image/A11 (2).jpg')}}" class="d-block w-100" alt="...">
            <div class="slider">
                <h1>Music Is Forever</h1>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('frontend-assets/image/A6.jpg')}}" class="d-block w-100" alt="...">
            <div class="slider">
                <h1>Amazing Sound Quality</h1>
            </div>
        </div> -->
    </div>
    <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
     </button>
    <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next">
       <span class="carousel-control-next-icon" aria-hidden="true"></span>
       <span class="sr-only">Next</span>
     </button>
</div>
@endsection
@section('content')

    <style>
        .music__player {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .music__player p{
            color: white;
            text-align: left;
            background: black;
            margin-left: 50px;
            padding: 8px;
            border-radius: 14px 14px 0px 0px;
            font-size: 14px;
            margin-bottom: 0px;
            width: fit-content;
        }
        @media (max-width: 768px) {
            #audioText, .mejs__container {
                width: 90% !important;
            }
        }
        .search_result_section {
            position: relative;
            display: flex;
            justify-content: center;
        }
        .search_result_container{
            position: absolute;
            top: -21px;
            z-index: 99999;
        }
        .search__wrapper {
            background: #fff;
            max-height: 201px;
            overflow: auto;
        }
        .search_result_item {
            padding: 0 0 0 20px;
            border-bottom: 1px solid #ccccccb3;
            line-height: 34px;
            margin: 0px;    
            border: 1px solid #d4d4d4;
            cursor: pointer;
            line-height: 38px;
        }
        .search_result_item:hover {
            background: #CC0066;
            color: #fff;
        }
    </style>
<section id="hero">
    <div class="container">
        <div class="searchwrapper">
            <div class="searchbox" id="searchbox">
                <div class="row">
                    <div class="col-md-2 flex">
                        <img src="{{ asset('frontend-assets/image/music.png')}}" alt="">
                        <span class="form-control"> <p>Music</p></span>
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control search-field" placeholder="Search by Title, Artist, Genre, Tempo, Version" name="search" value="{{ request()->input('search') }}" id="searchInput">
                    </div>
                    <div class="col-md-2"><input type="button" class="btn " class="form-control" value="Search" style="background:#CC0066;color:white;" onclick="gotoSearchPage()"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Search Result Section Start -->
<section class="search_result_section">
    <div class="container search_result_container">
        <div class="searchwrapper search__wrapper" id="search__wrapper" style="display: none;">
            <div id="dropdownResults">
                
            </div>
        </div>
    </div>
</section>
<!-- Search Result Section End -->

<section id="tabs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 genreimg" style="width:100%">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">
                            <img src="{{ asset('frontend-assets/image/music.png')}}" alt=""> Titles</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">
                            <img src="{{ asset('frontend-assets/image/artist.png')}}" alt="">&nbsp;Artist</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">
                            <img src="{{ asset('frontend-assets/image/genre.png')}}" alt="">&nbsp;Genre</a>
                    </div>
                </nav>
                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        @if($musicTitles->count() > 0)
                            @foreach($musicTitles as $musicTitle)
                                <div class="row" style="padding-top:2px;">
                                    <div class="col-md-1 pl-5 ">
                                        <img src="{{ asset('frontend-assets/image/play.png')}}" alt="">
                                    </div>
                                    <div class="col-md-4 pt-2">
                                        <p>{{ $musicTitle->title }}</p>
                                        <p>{{ $musicTitle->artist }}</p>
                                    </div>
                                    <div class="col-md-3  pt-2">{{ $musicTitle->version }}</div>
                                    <div class="col-md-2  pt-2">{{ $musicTitle->tempo }}</div>
                                    <div class="col-md-2 pt-2">
                                        <img src="{{ asset('frontend-assets/image/shopping.png')}}" alt="" style="padding-left:50%;">
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        @endif
                    </div>

                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row text-center" style="padding:5px 10px 0 10px;">
                            @if($artists->count() > 0)
                                @foreach($artists as $artist)
                                    <div class="col-md-2">
                                        <p>{{ $artist->name }}</p>
                                        <hr>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="row text-center" style="padding:5px 10px 0 10px;">
                            @if($genres->count() > 0)
                                @foreach($genres as $genre)
                                    <div class="col-md-2">
                                        <p>{{ $genre->name }}</p>
                                        <hr>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="section audioSection">
    <div class="row pt-3" style="background:#30343F">
        <div class="col text-center py-2 music__player">
            <?php $musicTitle = App\Models\MusicTitle::where('id', $homeContent->music_player_title_id)->first(); ?>
            @if($musicTitle)
                <div style="width: 60%;">
                    <p id="audioText">
                        <!-- <img src="{{ asset('frontend-assets/image/play-white.png')}}" alt="" style="width: 20px; height: 20px;">&nbsp;&nbsp; -->
                        <span>{{ $musicTitle->title }}</span><span style="color: #8d8989;"> | {{ $musicTitle->artist }}</span>
                    </p>
                </div>
                <audio id="myAudioPlayer" controls style="width: 60%">
                    <source src="{{ asset('admin-assets/audio/'.$musicTitle->file) }}" type="audio/mpeg">
                </audio>
            @endif
        </div>
    </div>
</div>
</div>

@if($faqs->count() > 0)
    <div class="container-fluid" id="faq-1">
        <div class="accordion" id="accordionExample">
            <h1 class="mb-5">Frequently Asked Questions</h1>
            @foreach($faqs as $faq)
                <div class="card">
                    <div class="card-header" id="heading{{ $faq->id }}">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}" style="text-decoration: none;display:flex; justify-content: space-between;" onclick="toggleFAQ({{ $faq->id }})">
                            <p style="font-weight: bold;">{{ $faq->question }}</p>
                            <img id="arrow{{ $faq->id }}" src="{{ asset('frontend-assets/image/downarrow.png')}}" width="30px" height="30px">
                        </button>
                    </div>

                    <div id="collapse{{ $faq->id }}" class="collapse" aria-labelledby="heading{{ $faq->id }}" data-parent="#accordionExample">
                        <div class="card-body faq_card_body">
                            {!! $faq->answer !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif


<div class="section" id="section" style="background-image: url('admin-assets/images/{{$homeContent->news_image}}');">
    <div class=" color-overlay d-flex justify-content-center hh" style="padding-top: 8%;text-align: center;">
        <div class="txtheading">
            <h1>{{$homeContent->news_heading}}</h1>
            <p>{{$homeContent->news_sub_heading}}</p>
        </div>
    </div>
    <form class="form-inline" style="justify-content: center;">
        <div class="form-group mb-2">
            <div class="img-3" style="border-width: 0; border-bottom: 1px solid white; border-radius: 0; background: transparent;">
                <img src="{{ asset('frontend-assets/image/mail-2.png')}}" alt="" class="mail">
                <hr>
                <input type="email" class="form-control" id="subscriber_email" placeholder="Your Email" style="border-width: 0; border: 0px; border-radius: 0; background: transparent;">
            </div>
        </div>
        <button type="button" class="btn btn-warning rounded-pill btn-block shadow-sm" id="subscribe_btn" style="width:12%;background:#CC0066;color:white;border-radius:0px;border: #CC0066;padding-bottom: 8px;">Subscribe</button>
    </form>
    <!-- Error Message -->
    <div class="alert alert-danger alert-dismissible fade show error_msg_alert" role="alert" style="width: fit-content;margin: 0 auto;margin-top: 10px; display: none;">
        <strong id="error_msg"></strong>
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.13/mediaelement-and-player.min.js"></script>
<script>
    $('#myAudioPlayer').mediaelementplayer();
    document.addEventListener('DOMContentLoaded', function() {
        // Handle the close button click
        var closeButton = document.querySelector('.error_msg_alert .close');
        closeButton.addEventListener('click', function() {
            var errorMsgAlert = document.querySelector('.error_msg_alert');
            errorMsgAlert.style.display = 'none';
        });

        var subscribeBtn = document.getElementById('subscribe_btn');
        subscribeBtn.addEventListener('click', function() {
            var subscriber_email = document.getElementById('subscriber_email').value;
            // Instead of button show bootstrap spinner
            subscribeBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
            subscribeBtn.disabled = true;
            if(subscriber_email == ''){
                var errorMsgAlert = document.querySelector('.error_msg_alert');
                errorMsgAlert.style.display = 'block';
                var errorMsg = document.getElementById('error_msg');
                errorMsg.innerHTML = 'Please enter your email address.';
                subscribeBtn.innerHTML = 'Subscribe';
                subscribeBtn.disabled = false;
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
                        subscribeBtn.innerHTML = 'Subscribe';
                        subscribeBtn.disabled = false;
                    }
                };
                xhr.send("email=" + encodeURIComponent(subscriber_email));
            }
        });
    });

    function toggleFAQ(faqId) {
        var button = document.getElementById("arrow" + faqId);
        var arrow = button.getAttribute("src");
        
        // Reset all other arrows to "downarrow.png"
        var allButtons = document.querySelectorAll("[id^='arrow']");
        allButtons.forEach(function(btn) {
            if (btn.id !== "arrow" + faqId) {
            btn.setAttribute("src", "{{ asset('frontend-assets/image/downarrow.png')}}");
            }
        });

        if (arrow.includes("downarrow.png")) {
            button.setAttribute("src", "{{ asset('frontend-assets/image/uparrow.png')}}");
        } else {
            button.setAttribute("src", "{{ asset('frontend-assets/image/downarrow.png')}}");
        }
    }

    $('#searchInput').on('keyup', function() {
        $searchInput = $('#searchInput').val();

        // if searchInput is empty then hide the search__wrapper
        if($searchInput == ''){
            // change border-radius of searchbox from 5px to 50px
            $('#searchbox').css('border-radius', '50px');
            $('#search__wrapper').css('display', 'none');
            return false;
        } else {
            // change border-radius of searchbox from 50px to 5px
            var xhr = new XMLHttpRequest();
            xhr.open('GET', "{{ route('frontend.search.music') }}?search=" + encodeURIComponent($searchInput));
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.data && response.data.length > 0) {
                        var html = '';
                        response.data.forEach(function(item) {
                            html += '<p class="search_result_item">' + item.title + '</p>';
                            html += '<p class="search_result_item">' + item.title + '</p>';
                        });
                        document.getElementById('searchbox').style.borderRadius = '5px';
                        document.getElementById('search__wrapper').style.display = 'block';
                        var dropdownResults = document.getElementById('dropdownResults');
                        dropdownResults.innerHTML = html;
                    } else {
                        document.getElementById('searchbox').style.borderRadius = '5px';
                        document.getElementById('search__wrapper').style.display = 'block';
                        var dropdownResults = document.getElementById('dropdownResults');
                        dropdownResults.innerHTML = '<p class="search_result_item">No result found.</p>';
                    }
                }
            };
            xhr.send();
        }

        // when user click on any search_result_item then set the value of searchInput to that item
        $(document).on('click', '.search_result_item', function() {
            var searchResultItem = $(this).text();
            $('#searchInput').val(searchResultItem);
        });

        // when user click on anywhere on the page then hide the search__wrapper but not on search_result_item and not on searchbox
        $(document).click(function(e) {
            if (!$(e.target).is('#searchbox')) {
                $('#search__wrapper').css('display', 'none');
            }
        });
    });

    // gotoSearchPage function 
    function gotoSearchPage() {
        var searchInput = $('#searchInput').val();
        if (searchInput == '') {
            return false;
        } else {
            window.location.href = "{{ route('frontend.music.search') }}/" + searchInput;
        }
    }
</script>

@endsection