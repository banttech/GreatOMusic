<?php

use Carbon\Carbon;

?>

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
        background-size: 100% 100%;
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

    .box-1 h2 {
        margin-left: -12px;
        font-size: 46px;
    }

    .mainbgsblack {
        border-bottom: 3px solid #CC0066;
        box-shadow: 0 7px 0 0px #000000;
    }

    .user_details {
        background: rgba(51, 51, 51, .20);
        padding: 5px;
    }

    .empty-sec {
        display: block;
        background: rgba(51, 51, 51, .20) !important;
        padding: 15px 30px;
        /*font-family: 'Open Sans' !important;*/
        font-size: 17px;
        font-weight: bolder;
        color: #000;
        cursor: pointer;
        text-align: center;
    }

    .empty-sec:hover {
        background: rgba(51, 51, 51, .5) !important;
        color: #fff;
    }

    .empty-sec:hover .music_search_link {
        color: #fff;
    }

    .music_search_link {
        text-decoration: underline !important;
        color: #666666;
    }

    .music_search_link:hover {
        color: #fff;
    }

    .expired {
        padding-top: 2px;
        background-color: red;
        margin: 0px 10px;
    }

    .pagination {
        margin-top: 10px;
    }

    .modal-title {
        text-align: center;
        margin: 25px 0px 5px 0;
        font-family: inherit;
        font-weight: bold;
        line-height: 20px;
        color: inherit;
        text-rendering: optimizelegibility;
        font-size: 30px;
    }

    .modal-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        border-bottom: none;
        position: relative;
    }

    .btn-close {
        position: absolute;
        right: 0;
        bottom: 0;
        margin: 10px !important;
    }

    .modal-centered {
        cursor: pointer;
    }

    .modal {
        background-color: rgba(255, 255, 255, 0.5) !important;
        animation: modalOpen 0.3s ease-in-out;
    }

    .modal-dialog {
        max-width: 1300px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        transform: scale(0.8);
        transition: transform 0.3s ease-in-out;
    }

    .modal-content {
        background-color: white;
        border: none;
        cursor: default;
    }

    .modal.show .modal-content {
        transform: scale(1);
    }

    @keyframes modalOpen {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .heading {
        display: inline-block;
        width: 100px;
    }
    
    .main-heading {
        display: inline-block;
        font-weight: bold;
    }
</style>

<style>
    .gap-6 {
        gap: 10px;
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

    @media (min-width: 992px) {
        .slider h1 {
            position: absolute;
            /* top: 27%; */
            font-size: 30px;
            margin-top: -35px;
        }
    }

    @media (max-width: 991px) {
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
            margin-top: 0px;
        }
    }

    @media (max-width: 768px) {

        #audioText,
        .mejs__container {
            width: 90% !important;
        }
    }

    @media (max-width: 500px) {
        .slider h1 {
            font-size: 20px;

        }

        .carousel-control-next-icon,
        .carousel-control-prev-icon {
            width: 15px;
            height: 15px
        }
    }

    @media (max-width: 375px) {
        .slider h1 {
            font-size: 15px !important;
            margin-top: 50px;

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

    .primarys {
        background: #CC0066;
        color: white;
        border-radius: 20px;
        padding: 4px 20px 7px 20px;
        margin-top: 2px;
    }

    #tabs {
        padding-top: 3%;
    }

    .gray-bar {
        background-color: rgba(51, 51, 51, .20) !important;
        color: #666666;
        height: 50px;
        width: 100%;
        margin-left: 0px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .gray-bar strong {
        /*font-family: 'Open Sans' !important;*/
        color: black;
    }

    .play_img {
        height: 40px;
        width: 40px;
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
                <h2>Account Details</h2>
                <a href="{{ route('frontend.edit.account') }}" class="pink right">Edit Account</a>
            </div>

        </div>
    </div>
</section>
<?php 
 $fkey = 0;
$ffile = '';
?>

@if($licenses && count($licenses) > 0)
<section id="tabs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 genreimg" style="width:100%">
                <div class="row gray-bar">
                    <strong>ANY EXPIRED LICENSES WILL BE DISPLAYED BELOW IN RED</strong>
                </div>
                <div class="tab-content pt-3 px-3 px-sm-0" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <?php 
                            $fMusicTitle = '';
                            $fMusicArtist = '';
                            $fMusicFile = '';
                            $fkey = 0;
                            $ffile = '';
                        ?>
                        @foreach($licenses as $key => $license)
                        <?php
                        $music = App\Models\MusicTitle::where('id', $license->track_id)->first();

                        $totalTime = $license->term;
                        $term = substr($totalTime, 0, 1);
                        $createdDate = Carbon::parse($license->date);
                        $expirationDate = $createdDate->addYears($term);
                        $isExpired = $expirationDate->isPast();
                        
                        if ($fMusicTitle == '') {
                            $fMusicTitle = $music->title;
                            $fkey = $key;
                            $ffile = $music->file;

                        }
                        if ($fMusicArtist == '') {
                            $fMusicArtist = $music->artist;
                        }
                        if ($fMusicFile == '') {
                            $fMusicFile = $music->file;
                        }
                        ?>


                        <div class="row d-flex align-items-center {{ $isExpired ? 'expired' : '' }}" style="padding-top:2px;">
                            <div class="col-md-1 pl-5 ">
                                <img class="play_img music-player-img" src="{{ asset('frontend-assets/image/play.png')}}" alt="" onclick="playAudio('{{ $music->file }}', '{{ $key }}')" height="50" width="50" style="cursor: pointer;" id="{{ $music->file . '__' . $key }}" data-title="{{ $music->title }}" data-artist="{{ $music->artist }}" data-file="{{ $music->file }}" data-key="{{ $key }}">
                            </div>
                            <div class="col-md-3 pt-2">
                                <strong>{{ $music->title }}</strong>
                            </div>
                            <div class="col-md-8 d-flex justify-content-center gap-6">
                                <a clsss=""><input type="button" class="btn " value="Info" style="background:#CC0066;color:white;border-radius:20px;padding:4px 20px 7px 20px; margin-top:2px;" onclick="showDetails('{{ $license->id }}')"></a>
                                <a href="{{ asset('admin-assets/audio/'.$music->file) }}" download><input type="button" class="btn " value="MP3 Download" style="background:#CC0066;color:white;border-radius:20px;padding:4px 20px 7px 20px; margin-top:2px;"></a>
                                <a href="{{ asset('admin-assets/audio/'.$music->file1) }}" download><input type="button" class="btn " value="WAV Download" style="background:#CC0066;color:white;border-radius:20px;padding:4px 20px 7px 20px; margin-top:2px;"></a>
                                <a href="{{ route('frontend.invoice', $license->random_id) }}"><input type="button" class="btn " value="Invoice" style="background:#CC0066;color:white;border-radius:20px;padding:4px 20px 7px 20px; margin-top:2px;"></a>
                                <a href="{{ route('frontend.agreement', $license->random_id) }}"><input type="button" class="btn " value="Agreement" style="background:#CC0066;color:white;border-radius:20px;padding:4px 20px 7px 20px; margin-top:2px;"></a>
                            </div>
                        </div>
                        <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pagination">
        {{ $licenses->links() }}
    </div>
    <!-- Media Player Start -->
    <div class="section audioSection">
        <div class="row pt-3">
            <div class="col text-center py-2 music__player">
                <!--<h1 style="color: black; font-weight: 700;">Music Title Featured</h1>-->
                <div style="width: 60%;">
                    <p id="audioText">
                        <span id="audioTitle">{{$fMusicTitle}}</span> | <span id="audioArtist"> {{$fMusicArtist}} </span>
                    </p>
                </div>
                <audio id="myAudioPlayer" controls style="width: 60%">
                    <source src="{{ asset('admin-assets/audio/'.$fMusicFile) }}" type="audio/mpeg" id="audioSource">
                </audio>
            </div>
        </div>
    </div>
    <!-- Media Player End -->
</section>
@else
<section class="about-inbox">
    <div class="container">
        <div class="row">
            <div class="width empty-sec">
                EMPTY
                <br />
                <span>
                    License music by visiting <a href="{{ route('frontend.music.search') }}" class="music_search_link">Music Search</a>
                </span>
                <!-- <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <p class="user_details">{{ $user->name }}</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <p class="user_details">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="mb-3">
                                <label for="company" class="form-label">Company Name</label>
                                <p class="user_details">{{ $user->company }}</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="mb-3">
                                <label for="position" class="form-label">Position</label>
                                <p class="user_details">{{ $user->position }}</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <p class="user_details">{{ $user->phone }}</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="mb-3">
                                <label for="city" class="form-label">City Name</label>
                                <p class="user_details">{{ $user->city }}</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="mb-3">
                                <label for="state" class="form-label">STATE</label>
                                <p class="user_details">{{ $user->state }}</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="mb-3">
                                <label for="country" class="form-label">COUNTRY</label>
                                <p class="user_details">{{ $user->country }}</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Website</label>
                                <p class="user_details">{{ $user->website }}</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="mb-2">
                                <label for="here_about_us" class="form-label">How Did You Hear About Us?</label>
                                <p class="user_details">{{ $user->referred_by }}</p>
                            </div>
                        </div>
                    </div> -->
            </div>
        </div>
    </div>
</section>
@endif

<!-- Modal Start -->
<!--<div class="modal modal-centered" id="infoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="modal-title"></h1>
                <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 450px; overflow-y: scroll;">
                <p class="mb-4">
                    <span class="heading">License :</span>
                    <span id="license-name"></span>
                </p>
                <p class="mb-4">
                    <span class="heading">Artist :</span>
                    <span id="artist-name"></span>
                </p>
                <p class="mb-4">
                    <span class="heading">Genre :</span>
                    <span id="genre"></span>
                </p>
                <p class="mb-4">
                    <span class="heading">Tempo :</span>
                    <span id="tempo"></span>
                </p>
                <p class="mb-4">
                    <span class="heading">Version :</span>
                    <span id="version"></span>
                </p>
                <p class="mb-4">
                    <span class="heading">Territory :</span>
                    <span id="territory"></span>
                </p>
                <p class="mb-4">
                    <span class="heading">Term :</span>
                    <span id="term"></span>
                </p>
                <p class="mb-4">
                    <span class="heading">Mp3 File :</span>
                    <a href="#" id="mp3-file" download>Download</a>
                </p>
                <p class="mb-4">
                    <span class="heading">Wav File :</span>
                    <a href="#" id="wav-file" download>Download</a>
                </p>
            </div>
        </div>
    </div>
</div>-->

<div class="modal modal-centered" id="infoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="modal-title1"></h1>
                <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 450px; overflow-y: scroll; padding-left:100px;">
                <p class="mb-2">
                    <span class="main-heading">Music Details</span>
                </p>
                <p class="mb-2">
                    <span class="heading">Title</span>
                    <span id="modal-title"></span>
                </p>
                <p class="mb-2">
                    <span class="heading">Artist</span>
                    <span id="artist-name"></span>
                </p>
                <p class="mb-2">
                    <span class="heading">Genre</span>
                    <span id="genre"></span>
                </p>
                <p class="mb-2">
                    <span class="heading">Tempo</span>
                    <span id="tempo"></span>
                </p>
                <p class="mb-2">
                    <span class="heading">Version</span>
                    <span id="version"></span>
                </p>
                
                
                <p class="mt-5 mb-2">
                    <span class="main-heading">License Details</span>
                </p>
                <p class="mb-2">
                    <span class="heading">License</span>
                    <span id="license-name"></span>
                </p>
                <p class="mb-2">
                    <span class="heading">Territory</span>
                    <span id="territory"></span>
                </p>
                <p class="mb-2">
                    <span class="heading">Term</span>
                    <span id="term"></span>
                </p>
                <p class="mb-2">
                    <span class="heading">Price</span>
                    <span id="price"></span>
                </p>
                <p class="mb-2">
                    <span class="heading">Date</span>
                    <span id="date"></span>
                </p>
                
                
                <!--<p class="mb-4">
                    <span class="heading">Mp3 File :</span>
                    <a href="#" id="mp3-file" download>Download</a>
                </p>
                <p class="mb-4">
                    <span class="heading">Wav File :</span>
                    <a href="#" id="wav-file" download>Download</a>
                </p>-->
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->


<!-- Media Play JS Start -->
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
    var globalAudioSrc = "{{$ffile}}";
    var globalKey = "{{$fkey}}";
    function playAudio(file, key) {
        // update the audio source using media player library
        var audioPlayer = document.getElementById('myAudioPlayer');
        audioPlayer.src = "{{ asset('admin-assets/audio/') }}/" + file;
        audioPlayer.play();

        globalAudioSrc = file;
        globalKey = key;


        // get data-title and data-artist of the audio file and set it to the audio player
        var title = document.getElementById(file + '__' + key).getAttribute('data-title');
        var artist = document.getElementById(file + '__' + key).getAttribute('data-artist');
        document.getElementById('audioTitle').innerHTML = title;
        document.getElementById('audioArtist').innerHTML =  artist;

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
        // var pauseBtn = document.getElementById(file + '__' + key);
        var pauseBtn = document.getElementById(globalAudioSrc + '__' + globalKey);
        pauseBtn.setAttribute('src', "{{ asset('frontend-assets/image/play.png')}}");
        pauseBtn.setAttribute('onclick', 'playAudio("' + file + '", "' + key + '")');
    }

    // when user play or pause the audio, update the play button of the audio file
    var audioPlayer = document.getElementById('myAudioPlayer');
    audioPlayer.addEventListener('play', function() {
        var file = audioPlayer.src.split('/').pop();
        var btn = document.getElementById(globalAudioSrc + '__' + globalKey);
        btn.setAttribute('src', "{{ asset('frontend-assets/image/music-play-img.png')}}");
        btn.setAttribute('onclick', 'pauseAudio("' + btn.getAttribute('data-file') + '", "' + btn.getAttribute('data-key') + '")');
        // var allPlayBtns = document.querySelectorAll('.music-player-img');
        // allPlayBtns.forEach(function(btn) {
        //     if (btn.getAttribute('data-file') == file) {
        //         btn.setAttribute('src', "{{ asset('frontend-assets/image/music-play-img.png')}}");
        //         btn.setAttribute('onclick', 'pauseAudio("' + btn.getAttribute('data-file') + '", "' + btn.getAttribute('data-key') + '")');
        //     }
        // });
    });

    audioPlayer.addEventListener('pause', function() {
        // alert(globalAudioSrc);
        // alert(globalKey);
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
<!-- Media Play JS End -->

<!-- Toastr Js Link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    function showDetails(id) {
        var allLicense = <?php echo json_encode($licenses); ?>;
        var licenseData = allLicense.data;
        var selectedLicense = licenseData.find(license => license.id == id);

        // append data to modal
        $('#modal-title').text(selectedLicense.music_title.title);
        $('#license-name').text(selectedLicense.license);
        $('#artist-name').text(selectedLicense.music_title.artist);
        $('#genre').text(selectedLicense.music_title.genre);
        $('#tempo').text(selectedLicense.music_title.tempo);
        $('#version').text(selectedLicense.music_title.version);
        $('#territory').text(selectedLicense.territory);
        $('#term').text(selectedLicense.term);

        var price = selectedLicense.price;
        // check if license has cart
        if (selectedLicense.cart != null) {
            var price = selectedLicense.cart.price;
            if (selectedLicense.cart.coupon_discount != null) {
                price = price - selectedLicense.cart.coupon_discount;
            }
        }

        price = Number(price);
        $('#price').text("$" + (price).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));

        // $('#price').text("$" + (selectedLicense.price).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        
        var dbDate = new Date(selectedLicense.date); // Replace with your database date

        var options = { 
          year: 'numeric',
          month: '2-digit',
          day: '2-digit'
        };

        var formattedDate = dbDate.toLocaleDateString('en-US', options).replace(/\//g, '-');;

        $('#date').text(formattedDate);
        $('#mp3-file').attr('href', 'admin-assets/audio/' + selectedLicense.music_title.file);
        $('#wav-file').attr('href', 'admin-assets/audio/' + selectedLicense.music_title.file1);


        // open the info modal
        var modal = document.getElementById('infoModal');
        var bootstrapModal = new bootstrap.Modal(modal);
        bootstrapModal.show();
    }
</script>


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