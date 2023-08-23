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
            <!-- <div class="slider">
                <h1>{{ $slider->text }}</h1>
            </div> -->
            
            <div class="carousel-caption d-none d-md-block d-sm-block">
                <h1>{{ $slider->text }}</h1>
            </div>
        </div>
        @endforeach
        @endif
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
    .carousel-caption {
        padding-top:0px!important;
        padding-bottom:0px!important;
        bottom:50%!important;
        top:38%!important;
        /*left:30%;*/
    }
    
    .carousel-caption h1 {
        background: #CC0066;
        width: fit-content;
        padding: 12px;
        color: #fff;
        margin:auto;
    }
    
    @media screen and (max-width: 991px) {
        .carousel-caption {
            top:48%!important;
        }
        
        .mplyr_wdh {
            width: 60%;
        }
    }
    
    .music__player {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .music__player h1 {
        color: white;
        padding-bottom: 44px;
    }

    .music__player p {
        color: white;
        text-align: left;
        background: black;
        /* margin-left: 50px; */
        padding: 4px 6px 4px 12px;
        border-radius: 14px 14px 0px 0px;
        font-size: 14px;
        margin-bottom: 0px;
        /* width: fit-content; */
    }

    .mejs__controls {
        border-radius: 0px 0px 13px 13px;
    }

    #searchbox {
        border-radius: 5px !important;
    }

    @media screen and (min-width: 992px) {
        .slider h1 {
            position: absolute;
            /* top: 27%; */
            font-size: 30px;
            /*margin-top: -35px;*/
            /*margin-top: 50px;*/
        }
        
        /*.carousel-caption {
            top:120px!important;
        }*/
        
        .mplyr_wdh {
            width: 60%;
        }
    }
    
    @media screen and (max-width: 1629px) and (min-width: 1380px) {
        .carousel-caption {
            top:175px!important;
        }
        
        .mplyr_wdh {
            width: 60%;
        }
    }
    
    @media screen and (max-width: 1730px) and (min-width: 1630px) {
        .carousel-caption {
            top:198px!important;
        }
        
        .mplyr_wdh {
            width: 60%;
        }
    }
    
    @media screen and (max-width: 1829px) and (min-width: 1731px) {
        .carousel-caption {
            top:192px!important;
        }
        
        .mplyr_wdh {
            width: 60%;
        }
    }
    
    @media screen and (max-width: 1915px) and (min-width: 1830px) {
        .carousel-caption {
            top:228px!important;
        }
        
        .mplyr_wdh {
            width: 60%;
        }
    }
    
    @media screen and (max-width: 1919px) and (min-width: 1917px) {
        .carousel-caption {
            top:215px!important;
        }
        
        .mplyr_wdh {
            width: 60%;
        }
    }
    
    @media screen and (max-width: 2023px) and (min-width: 1920px) {
        .carousel-caption {
            top:227px!important;
        }
        
        .mplyr_wdh {
            width: 60%;
        }
    }
    
    @media screen and (max-width: 2109px) and (min-width: 2024px) {
        .carousel-caption {
            top:240px!important;
        }
        
        .mplyr_wdh {
            width: 60%;
        }
    }
    
    @media screen and (max-width: 2281px) and (min-width: 2110px) {
        .carousel-caption {
            top:262px!important;
        }
        
        .mplyr_wdh {
            width: 60%;
        }
    }
    
    

    @media screen and (max-width: 991px) {
        
        .mplyr_wdh {
            width: 60%;
        }
        
        .carousel-control-prev {
            bottom: -60px;
        }

        .carousel-control-next {
            bottom: -60px;
        }

        #nav-home p {
            line-height: 1.5;
        }

        p {
            margin-top: 0;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .slider h1 {
            position: absolute;
            /* top: 27%; */
            font-size: 30px;
            /*margin-top: 25px;*/
            bottom: -60px;
        }
    }

    @media screen and (max-width: 768px) {
        #audioText,
        .mejs__container {
            width: 90% !important;
        }
        
        .music__player p {
            margin: auto;
        }
        
        .mplyr_wdh {
            width: 100%;
        }
        
        .active_link {
            width: 70px;
        }
    }

    @media screen and (max-width: 500px) {
        .slider h1 {
            font-size: 20px;

        }
        
        .mplyr_wdh {
            width: 100%;
        }

        .carousel-control-next-icon,
        .carousel-control-prev-icon {
            width: 15px;
            height: 15px
        }
        
         .music__player p{
            font-size: 13px;
        }
    }
    
    @media screen and (max-width: 350px){
        .music__player p{
            font-size: 11px;
        }
        
        .mplyr_wdh {
            width: 100%;
        }
    }
    
    @media screen and (max-width: 280px){
        .music__player p{
            font-size: 8px;
        }
        
        .searchbox input[type="text"] {
            width: 220px;
            font-size: 9px;
        }
        
        .mplyr_wdh {
            width: 100%;
        }
    }

    .search_result_section {
        position: relative;
        display: flex;
        justify-content: center;
    }

    .search_result_container {
        position: absolute;
        top: -21px;
        z-index: 99999;
    }

    .search__wrapper {
        background: #fff;
        max-height: 201px;
        overflow: auto;
        scroll-behavior: smooth;
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

    .search_result_item.selected {
        background: #CC0066;
        color: #fff;
        outline: none;
    }

    .music_title_link {
        color: #000;
    }

    .music_title_link:hover {
        color: #CC0066;
    }

    .mejs__container {
        border-radius: 0px 0px 14px 14px;
    }

    #audioText p {
        color: white;
    }

    #audioText span {
        color: white;
    }

    .mejs__container {
        padding-bottom: 56px;
    }

    .mejs__controls {
        padding-bottom: 50px;
    }
    
    input#subscriber_email::placeholder {
			color: white;   
		}
</style>
<section id="hero">
    <div class="container">
        <div class="searchwrapper">
            <div class="searchbox" id="searchbox">
                <div class="row">
                    <div class="col-md-2 flex">
                        <img src="{{ asset('frontend-assets/image/music.png')}}" alt="">
                        <span class="form-control">
                            <p>Music</p>
                        </span>
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
                        @foreach($musicTitles as $key => $musicTitle)
                        <div class="row" style="padding-top:2px;">
                            <div class="col-md-1 pl-5 ">
                                <img class="music-player-img" src="{{ asset('frontend-assets/image/play.png')}}" alt="" onclick="playAudio('{{$musicTitle->file}}','{{$key}}')" height="50" width="50" style="cursor: pointer;" id="{{ $musicTitle->file . '__' . $key }}" data-title="{{ $musicTitle->title }}" data-artist="{{ $musicTitle->artist }}" data-file="{{ $musicTitle->file }}" data-key="{{ $key }}">
                            </div>
                            <div class="col-md-4 pt-2">
                                <a href="{{ route('frontend.music.search') }}?q=&title={{ $musicTitle->title }}&artist=&genre=&tempo=&version=" class="music_title_link">
                                    {{ $musicTitle->title }}
                                </a>
                                <p>{{ $musicTitle->artist }}</p>
                            </div>
                            <div class="col-md-3  pt-2">{{ $musicTitle->version }}</div>
                            <div class="col-md-2  pt-2">{{ $musicTitle->tempo }}</div>
                            <div class="col-md-2 pt-2">
                                <?php $file = isset($musicTitle->file) ? pathinfo($musicTitle->file, PATHINFO_FILENAME) : '' ?>
                                <a href="{{ route('frontend.cart.add', ['id' => $musicTitle->id,'file' => $file, 'cart_item' => 0]) }}">
                                    <img src="{{ asset('frontend-assets/image/shopping.png')}}" alt="" style="padding-left:50%;">
                                </a>
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
                                <a href="{{ route('frontend.music.search') }}?q=&title=&artist={{ $artist->id }}&genre=&tempo=&version=" class="music_title_link">
                                    {{ $artist->name }}
                                </a>
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
                                <a href="{{ route('frontend.music.search') }}?q=&title=&artist=&genre={{ $genre->name }}&tempo=&version=" class="music_title_link">
                                    {{ $genre->name }}
                                </a>
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
            <h1>Music Title Featured</h1>
            <?php 
                $featuredKey = 0;
                $featuredFile = '';
                $featuredMusicTitle = App\Models\MusicTitle::where('id', $homeContent->music_player_title_id)->first();
                $featuredFile = $featuredMusicTitle->file ?? '';
                if($musicTitles->count() > 0){
                foreach($musicTitles as $key => $musicTitle){
                    if(isset($featuredMusicTitle->id) && $musicTitle->id == $featuredMusicTitle->id){
                        $featuredKey = $key;
                    }
                }}
            ?>
            @if($featuredMusicTitle)
            <div class="mplyr_wdh">
                <p id="audioText">
                    <!-- <img src="{{ asset('frontend-assets/image/play-white.png')}}" alt="" style="width: 20px; height: 20px;">&nbsp;&nbsp; -->
                    <span id="audioTitle">{{ $featuredMusicTitle->title }}</span> | <span id="audioArtist"> {{ $featuredMusicTitle->artist }}</span>
                </p>
            </div>
            <audio id="myAudioPlayer" controls style="width: 60%">
                <source src="{{ asset('admin-assets/audio/'.$featuredMusicTitle->file) }}" type="audio/mpeg" id="audioSource">
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
        <div class="form-group mb-2" style="justify-content: center;width:16%;">
            <div class="img-3" style="border-width: 0; border-bottom: 1px solid white; border-radius: 0; background: transparent;width:100%;">
                <img src="{{ asset('frontend-assets/image/mail-2.png')}}" alt="" class="mail">
                <hr>
                <input type="email" class="form-control" id="subscriber_email" placeholder="Your Email" style="border-width: 0; border: 0px; border-radius: 0; background: transparent;">
            </div>
        </div>
        <button type="button" class="btn btn-warning rounded-pill btn-block shadow-sm" id="subscribe_btn" style="width:6%;background:#CC0066;color:white;border-radius:0px;border: #CC0066;">Subscribe</button>
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
            if (subscriber_email == '') {
                var errorMsgAlert = document.querySelector('.error_msg_alert');
                errorMsgAlert.style.display = 'block';
                var errorMsg = document.getElementById('error_msg');
                errorMsg.innerHTML = 'Please enter your email address.';
                subscribeBtn.innerHTML = 'Subscribe';
                subscribeBtn.disabled = false;
            } else {
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

    $(document).ready(function() {
        const searchInput = document.getElementById('searchInput');
        const searchBox = document.getElementById('searchbox');
        const searchWrapper = document.getElementById('search__wrapper');
        const dropdownResults = document.getElementById('dropdownResults');
        let selectedItemIndex = -1;

        searchInput.addEventListener('keyup', function(e) {
            const searchValue = searchInput.value;

            // If searchInput is empty, hide the search__wrapper and change border-radius of searchbox
            if (searchValue === '') {
            searchWrapper.style.display = 'none';
            return false;
            }

            // check if press enter key then redirect to search page
            if (e.key === 'Enter') {
                gotoSearchPage();
            }

            const xhr = new XMLHttpRequest();
            xhr.open('GET', "{{ route('frontend.search.music') }}?search=" + encodeURIComponent(searchValue));
            xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.data && response.data.length > 0) {
                let html = '';
                response.data.forEach(function(item, index) {
                    html += `<p class="search_result_item ${index === selectedItemIndex ? 'selected' : ''}" tabindex="0">${item.title}</p>`;
                });
                searchWrapper.style.display = 'block';
                dropdownResults.innerHTML = html;
                } else {
                searchWrapper.style.display = 'block';
                dropdownResults.innerHTML = '<p class="search_result_item">No result found.</p>';
                }
            }
            };
            xhr.send();
        });

        // When user clicks on any search_result_item, set the value of searchInput to that item
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('search_result_item')) {
            const searchResultItem = e.target.textContent;
            const redirectUrl = `{{ route('frontend.music.search') }}?q=${searchResultItem}&title=${searchResultItem}&artist=&genre=&tempo=&version=`;
            window.location.href = redirectUrl;
            }
        });

        // When user clicks anywhere on the page except the searchbox, hide the search__wrapper
        document.addEventListener('click', function(e) {
            if (!e.target.matches('#searchbox')) {
            searchWrapper.style.display = 'none';
            }
        });

        // Keyboard navigation
        $(document).on('keydown', function(e) {
            const searchResults = document.querySelectorAll('.search_result_item');

            if (!searchWrapper.style.display || searchWrapper.style.display === 'none') {
            return;
            }

            if (e.key === 'ArrowUp') {
                e.preventDefault();
                selectedItemIndex = Math.max(selectedItemIndex - 1, 0);
            } else if (e.key === 'ArrowDown') {
                e.preventDefault();
                selectedItemIndex = Math.min(selectedItemIndex + 1, searchResults.length - 1);
            } else if (e.key === 'Enter') {
                e.preventDefault();
                const selectedElement = document.querySelector('.search_result_item.selected');
                if (selectedElement) {
                    const searchResultItem = selectedElement.textContent;
                    const redirectUrl = `{{ route('frontend.music.search') }}?q=${searchResultItem}&title=${searchResultItem}&artist=&genre=&tempo=&version=`;
                    window.location.href = redirectUrl;
                }
            }

            searchResults.forEach(function(item, index) {
                if (index === selectedItemIndex) {
                    item.classList.add('selected');
                    item.focus();
                } else {
                    item.classList.remove('selected');
                }
            });

            // Scroll to selected item
            const selectedElement = document.querySelector('.search_result_item.selected');
            if (selectedElement) {
            selectedElement.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest',
                inline: 'start'
            });
            }
        });
    });

    // gotoSearchPage function 
    function gotoSearchPage() {
        var searchInput = $('#searchInput').val();
        if (searchInput == '') {
            return false;
        } else {
            window.location.href = "{{ route('frontend.music.search') }}?q=" + searchInput + "&title=&artist=&genre=&tempo=&version=";
        }
    }
    var globalAudioSrc = "{{$featuredFile}}"

    var globalKey = "{{$featuredKey}}"
    function playAudio(file, key) {

        var audioPlayer = document.getElementById('myAudioPlayer');
        audioPlayer.src = "{{ asset('admin-assets/audio/') }}/" + file;
        audioPlayer.play();

        globalAudioSrc = file;
        globalKey = key;

        // get data-title and data-artist of the audio file and set it to the audio player
        var title = document.getElementById(file + '__' + key).getAttribute('data-title');
        var artist = document.getElementById(file + '__' + key).getAttribute('data-artist');
        document.getElementById('audioTitle').innerHTML = title;
        document.getElementById('audioArtist').innerHTML = artist;

        // for every button of class music-player-img, change the src to play image
        var allPlayBtns = document.querySelectorAll('.music-player-img');
        allPlayBtns.forEach(function(btn) {
            btn.setAttribute('src', "{{ asset('frontend-assets/image/play.png')}}");
            btn.setAttribute('onclick', 'playAudio("' + btn.getAttribute('data-file') + '", "' + btn.getAttribute('data-key') + '")');
        });

        // change the play button to pause button
        var playBtn = document.getElementById(file + '__' + key);
        playBtn.setAttribute('src', "{{ asset('frontend-assets/image/music-play-img.png')}}");
        playBtn.setAttribute('onclick', 'pauseAudio("' + file + '", "' + key + '")');
    }

    function pauseAudio(file, key) {

        var audioPlayer = document.getElementById('myAudioPlayer');
        audioPlayer.pause();
        var pauseBtn = document.getElementById(globalAudioSrc + '__' + globalKey);
        pauseBtn.setAttribute('src', "{{ asset('frontend-assets/image/play.png')}}");
        pauseBtn.setAttribute('onclick', 'playAudio("' + file + '", "' + key + '")');
    }

    var audioPlayer = document.getElementById('myAudioPlayer');
    audioPlayer.addEventListener('play', function() {

        var btn = document.getElementById(globalAudioSrc + '__' + globalKey);
        btn.setAttribute('src', "{{ asset('frontend-assets/image/music-play-img.png')}}");
        btn.setAttribute('onclick', 'pauseAudio("' + btn.getAttribute('data-file') + '", "' + btn.getAttribute('data-key') + '")');

    });

    audioPlayer.addEventListener('pause', function() {
        var file = audioPlayer.src.split('/').pop();

        var btn = document.getElementById(globalAudioSrc + '__' + globalKey);
            btn.setAttribute('src', "{{ asset('frontend-assets/image/play.png')}}");
            btn.setAttribute('onclick', 'playAudio("' + btn.getAttribute('data-file') + '", "' + btn.getAttribute('data-key') + '")');

        // var allPlayBtns = document.querySelectorAll('.music-player-img');
        // allPlayBtns.forEach(function(btn) {
        //     if (btn.getAttribute('data-file') == file) {
        //         btn.setAttribute('src', "{{ asset('frontend-assets/image/play.png')}}");
        //         btn.setAttribute('onclick', 'playAudio("' + btn.getAttribute('data-file') + '", "' + btn.getAttribute('data-key') + '")');
        //     }
        // });
    });
</script>
<!-- Toastr Js Link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@if(Session::has('success-toast'))
<script>
    toastr.success("{{ Session::get('success-toast') }}");
</script>
@endif

@if(Session::has('error-toast'))
<script>
    toastr.error("{{ Session::get('error-toast') }}");
</script>
@endif

@endsection
