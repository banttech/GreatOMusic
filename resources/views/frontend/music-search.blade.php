@extends('layouts.frontend.app')
@section('content')

<?php
$pagesmusicsearch = DB::table('music_search')->first();
?>

<style>
		.musicsearch_section {
        background: url("{{ asset('admin-assets/images/'.$pagesmusicsearch->headerimg) }}");
        min-height: 300px;
        object-fit: cover;
        background-size: 100% 100%;    
    }
    
    .dropdown-values {
        display: none;
        margin-left: 40px;
        max-height: 150px;
        margin-top: 16px;
        margin-right: 40px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .dropdown-values.show {
        display: block;
    }

    .artist__name {
        margin-left: 10px;
    }

    .pagination {
        margin-top: 35px;
        margin-bottom: 35px;
    }

    .table_pra p {
        line-height: 20px
    }

    .searchwrapper-2 {
        width: 100%;
        margin-top:19px;
        margin-bottom:14px;
    }

    .searchwrapper {
        width: 100%;
    }

    .searchbox .col-md-1 {
        padding-top: 2px;
        padding-bottom: 3px;
        padding-left: 16px;
    }

    .searchbox .col-md-10 {
        padding-top: 2px;
        padding-bottom: 3px;
        padding-left: 0px;
    }

    .tbl_heading {
        margin-left: 18px;
    }

    #back {
        background: white;
    }

    input#search {
        background: white;
    }

    .btn-1 {
        background: #cc0066;
    }

    .inner_table {
        padding-top: 0px;
        margin-left: -15px;
        margin-right: -15px;
    }

    @media (max-width:991px) {
        .row-tab {
            flex-direction: column;
            align-items: start;
        }

        .row-tab-1 {
            border-bottom: 1px solid #ccc;
            width: 100%;
            padding: 10px 0;
        }

        .sign_plus {
            position: absolute;
            left: 120px;
        }

        .pagination {
            max-width: 400px;
            margin-left: auto;
        }

        #music-list {
            overflow-x: scroll;
        }
    }

    .search_result_section {
        position: relative;
        display: flex;
        justify-content: center;
    }

    .search_result_container {
        position: absolute;
        top: -27px;
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

    .width {
        width: 100%;
        background: #fff;
        padding: 25px 20px 6px 20px;
        margin: 60px 0px;
    }

    .box-1 h2 {
        margin-left: -12px;
        font-size: 46px;
    }

    .mainbgsblack {
        border-bottom: 3px solid #CC0066;
        box-shadow: 0 7px 0 0px #000000;
    }

    /* music button */
    .searchbox .btn-1 {
        border-radius: 40px;
        padding: 6px 19px;
        margin-top: 0px;
        margin-bottom: 3px;
        margin-left: 16px;
    }

    input#search {
        width: 100%;
    }

    /* music search box */
    div#searchbox {
        border-radius: 5px !important;
    }

    #back {
        border-radius: 5px !important;
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

    .mejs__container {
        border-radius: 0px 0px 14px 14px;
    }

    .mejs__controls:not([style*="display: none"]) {
        background: unset;
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

    @media (max-width:768px){
        .inner_table {
            width: 106%;
        }
    }

    @media (max-width:500px){
        .inner_table {
            width: 107%;
        }
        .pagination {
            margin: auto;
            padding: 39px 0px;
        }
        .page-link {
            padding: 0px 3px;
        }
    }
    
    @media (max-width:471px) {
        .page-link {
            margin-left: -4px!important;
            padding: 1px 5px!important;
            font-size: 13px!important;
        }
    }
    
    

    @media (max-width:400px){
        .inner_table {
            width: 110%;
        }
        .page-link {
            margin-left: -7px!important;
            padding: 0px 3px!important;
            font-size: 12px!important;
        }
    }

    @media (max-width:350px){
        .page-link {
            margin-left: -7px!important;
            padding: 2px 4px !important;
            font-size: 8px!important;
        }
        .inner_table {
            width: 112%;
        }
    }

    @media screen and (max-width: 280px){
        .page-link {
            margin-left: -11px;
            padding: 2px 4px !important;
            font-size: 7px;
        }
        .inner_table {
            width: 112%;
        }
    }

</style>
<?php
$pagesmusicsearch = DB::table('music_search')->first();
?>
<div class="heading-section">
    <div class="" id="set">
        <div class="m-0">
            <!--<div class="d-flex align-items-end bd-highlight" style="background: url({{ url('admin-assets/images/'. $pagesmusicsearch->headerimg)}}) no-repeat 0 0 !important;">-->
            <div class="d-flex align-items-end bd-highlight musicsearch_section">
                <div class="mainbgsblack" style="background-color: rgba(0, 0, 0, 0.8);width: 100%;">
                    <div class="container">
                        <div class="box-1 w-100">
                            <h2>Music Search</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid " style="background:#252525;">
    <div class="row">
        <div class="col-md-3 pl-5 pt-4 remove_filtter" style="background:#1B1B1B; color:white;">
            Filters
        </div>
        <div class="col-md-9">
            <div class="searchwrapper-2">
                <div class="searchbox" id="back">
                    <form onSubmit="event.preventDefault(); gotoSearchPage();" class="msrhbox">
                        <div class="row d-flex mr-2">
                            <div class="aftab d-flex">
                                <img src="{{ asset('frontend-assets/image/music.png')}}" alt="">
                                <span class="form-control">
                                    <p>Music</p>
                                </span>
                                <!-- <img src="{{ asset('frontend-assets/image/search-white.png')}}" alt=""> -->
                            </div>
                            <div class="" style="flex-grow: 1;">
                                <!-- <input type="text" class="form-control search-field" id="search" placeholder="Search by Title, Artist, Genre, Tempo, Version" name="search" style="width:95%;margin:auto;" value="{{ request()->filled('q') ? request()->q : (request()->filled('title') ? request()->title : '') }}"> -->

                                <input type="text" class="form-control search-field" id="searchInput" placeholder="Search by Title, Artist, Genre, Tempo, Version" name="search" style="width:95%;margin:auto;" value="{{ request()->q }}">
                            </div>
                            <div class=""><input type="submit" class="btn-1 " class="form-control" value="Search" style="color:white;border:none;"></div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Search Result Section Start -->
            <div class="search_result_section">
                <div class="container search_result_container col-md-12 m-0 p-0">
                    <div class="searchwrapper search__wrapper" id="search__wrapper" style="display: none;">
                        <div id="dropdownResults">
                                
                        </div>
                    </div>
                </div>
            </div>
            <!-- Search Result Section End -->
        </div>
    </div>
</div>

<section class="section-slid">
    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-3 text-white tab-padding py-5" style="background:#1B1B1B;">
                <div class="row-tab">
                    <div class="row row-tab-1" onclick="toggleDropdown('artist')" style="cursor: pointer;">
                        <div class="col-md-9 tab-icon pl-4">
                            <img src="{{ asset('frontend-assets/image/imgpsh_fullsize_anim (4).png') }}" alt="" style="width: 20px;height: 19px; padding-right: 5px;">
                            <b style="margin-left: 9px;">Artist</b>
                        </div>
                        <div class="col-md-3 sign_plus">+</div>
                    </div>
                    <div id="artistDropdown" class="dropdown-values">
                        @if(count($artists) > 0)
                        <?php $selectedArtist = explode(',', request()->artist); ?>
                        @foreach($artists as $artist)
                        <div class="artistlist">
                            <input type="checkbox" id="artist{{ $artist->id }}" name="artist{{ $artist->id }}" value="{{ $artist->id }}" onclick="filterMusic()" @if(in_array($artist->id, $selectedArtist)) checked @endif>
                            <label for="artist{{ $artist->id }}" class="artist__name">
                                <?php $totalArtist = App\Models\MusicTitle::where('artist', $artist->name)->count(); ?>
                                {{$artist->name}} [{{$totalArtist}}]
                            </label>
                        </div>
                        @endforeach
                        @else
                        <p>
                            No artist found.
                        </p>
                        @endif
                    </div>
                    <hr>
                    <div class="row row-tab-1" onclick="toggleDropdown('genre')" style="cursor: pointer;">
                        <div class="col-md-9 tab-icon pl-4">
                            <img src="{{ asset('frontend-assets/image/genre-white.png') }}" alt="" style="width: 20px;height: 19px; padding-right: 5px;">
                            <b style="margin-left: 9px;">Genre</b>
                        </div>
                        <div class="col-md-3 sign_plus">+</div>
                    </div>
                    <div id="genreDropdown" class="dropdown-values">
                        @if(count($genres) > 0)
                        <?php $selectedGenre = explode(',', request()->genre); ?>
                        @foreach($genres as $genre)
                        <div>
                            <input type="checkbox" id="genre{{ $genre->id }}" name="genre{{ $genre->id }}" value="{{ $genre->name }}" onclick="filterMusic()" @if(in_array($genre->name, $selectedGenre)) checked @endif>
                            <label for="genre{{ $genre->id }}" class="artist__name">
                                <?php $totalGenre = App\Models\MusicTitle::where('genre', $genre->name)->count(); ?>
                                {{ $genre->name }} [{{ $totalGenre }}]
                            </label>
                        </div>
                        @endforeach
                        @else
                        <p>
                            No genre found.
                        </p>
                        @endif
                    </div>
                    <hr>
                    <div class="row row-tab-1" onclick="toggleDropdown('tempo')" style="cursor: pointer;">
                        <div class="col-md-9 tab-icon pl-4">
                            <img src="{{ asset('frontend-assets/image/tower.png') }}" alt="" style="width: 30px;height: 30px; padding-right: 5px;">
                            <b style="margin-left: 1px;">Tempo</b>
                        </div>
                        <div class="col-md-3 sign_plus">+</div>
                    </div>
                    <div id="tempoDropdown" class="dropdown-values">
                        @if(count($tempos) > 0)
                        <?php $selectedTempo = explode(',', request()->tempo); ?>
                        @foreach($tempos as $tempo)
                        <div>
                            <input type="checkbox" id="tempo{{ $tempo->id }}" name="tempo{{ $tempo->id }}" value="{{ $tempo->name }}" onclick="filterMusic()" @if(in_array($tempo->name, $selectedTempo)) checked @endif>
                            <label for="tempo{{ $tempo->id }}" class="artist__name">
                                <?php $totalTempo = App\Models\MusicTitle::where('tempo', $tempo->name)->count(); ?>
                                {{ $tempo->name }} [{{ $totalTempo }}]
                            </label>
                        </div>
                        @endforeach
                        @else
                        <p>
                            No tempo found.
                        </p>
                        @endif
                    </div>
                    <hr>
                    <div class="row row-tab-1" onclick="toggleDropdown('version')" style="cursor: pointer;">
                        <div class="col-md-9 tab-icon pl-4">
                            <img src="{{ asset('frontend-assets/image/lyrics.png') }}" alt="" style="width: 27px;height: 19px; padding-right: 5px;">
                            <b style="margin-left: 6px;">Version</b>
                        </div>
                        <div class="col-md-3 sign_plus">+</div>
                    </div>
                    <div id="versionDropdown" class="dropdown-values">
                        @if(count($versions) > 0)
                        <?php $selectedVersion = explode(',', request()->version); ?>
                        @foreach($versions as $version)
                        <div>
                            <input type="checkbox" id="version{{ $version->id }}" name="version{{ $version->id }}" value="{{ $version->name }}" onclick="filterMusic()" @if(in_array($version->name, $selectedVersion)) checked @endif>
                            <label for="version{{ $version->id }}" class="artist__name">
                                <?php $totalVersion = App\Models\MusicTitle::where('version', $version->name)->count(); ?>
                                {{ $version->name }} [{{ $totalVersion }}]
                            </label>
                        </div>
                        @endforeach
                        @else
                        <p>
                            No version found.
                        </p>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-md-9" id="music_list_data">
                <div class="inner_table">
                    <div>
                        <table class="table table-dark">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="width-30">
                                        <p class="text-white tbl_heading">Title</p>
                                    </th>
                                    <th scope="col" class="width-15">
                                        <p class="text-white tbl_heading">Genre</p>
                                    </th>
                                    <th scope="col" class="width-15">
                                        <p class="text-white tbl_heading">Tempo</p>
                                    </th>
                                    <th scope="col" class="width-15">
                                        <p class="text-white tbl_heading">Version</p>
                                    </th>
                                    <th scope="col" class="width-25"> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $fMusicTitle = '';
                                    $fMusicArtist = '';
                                    $fMusicFile = '';
                                    $fkey = 0;
                                    $ffile = '';
                                ?>
                                @if(count($musics) > 0)
                                @foreach($musics as $key => $music)
                                <?php 
                                    if($fMusicTitle == '') {
                                        $fMusicTitle = $music->title;
                                        $fkey = $key;
                                        $ffile = $music->file;
                                    }
                                    if($fMusicArtist == '') {
                                        $fMusicArtist = $music->artist;
                                    }
                                    if($fMusicFile == '') {
                                        $fMusicFile = $music->file;
                                    }
                                ?>
                                <tr>
                                    <td scope="row">
                                        <div class="table_img">
                                            <img class="music-player-img" src="{{ asset('frontend-assets/image/1.png')}}" alt="" style="width: 37px;height: 37px; cursor: pointer;" onclick="playAudio('{{ $music->file }}', '{{ $key }}')" style="cursor: pointer;" id="{{ $music->file . '__' . $key }}" data-title="{{ $music->title }}" data-artist="{{ $music->artist }}" data-file="{{ $music->file }}" data-key="{{ $key }}">
                                            <div class="table_pra">
                                                <p>
                                                    {{ $music->title }}
                                                </p>
                                                <p class="text-secondary">
                                                    {{ $music->artist }}
                                                </p>
                                            </div>
                                        </div>
                                        </th>
                                    <td>
                                        <p class="td_pra"> {{ $music->genre }}</p>
                                    </td>
                                    <td>
                                        <p class="td_pra"> {{ $music->tempo }}</p>
                                    </td>
                                    <td>
                                        <p class="td_pra"> {{ $music->version }}</p>
                                    </td>
                                    <td>
                                        <?php
                                        $file = pathinfo($music->file, PATHINFO_FILENAME);
                                        ?>
                                        <a href="{{ route('frontend.cart.add', ['id' => $music->id,'file' => $file, 'cart_item' => 0]) }}">
                                            <button class="btn-3" style="color: #fff; padding: 7px 18px!important; border: none; background: #cc0066;"> <img src="{{ asset('frontend-assets/image/carticon.png')}}" style="width: 16px; height:1ypx;padding-bottom: 2px;" alt="">
                                                CART
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5" class="text-center">No tracks found.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="d-felx justify-content-center" id="music-list">
                    {{ $musics->links() }}
                </div>
                <!-- Media Player -->
                <div class="section audioSection">
                    <div class="row pt-3">
                        <div class="col text-center py-2 music__player">
                            <div style="width: 100%;">
                                <p id="audioText">
                                    <span id="audioTitle">{{$fMusicTitle}}</span> @if($fMusicTitle) | @endif <span id="audioArtist"> {{$fMusicArtist}} </span>
                                </p>
                            </div>
                            <audio id="myAudioPlayer" controls style="width: 100%">
                                <source src="{{ asset('admin-assets/audio/'.$fMusicFile) }}" type="audio/mpeg" id="audioSource">
                            </audio>
                        </div>
                    </div>
                </div>
                <!-- Media Player End -->
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        var prevPage = parseInt($('.pagination .active').text()) - 1;
        var nextPage = parseInt($('.pagination .active').text()) + 1;
        var prevPageLink = $('.pagination li:nth-child(2) a').text();
        var nextPageLink = $('.pagination li:nth-last-child(2) a').text();
        if (prevPageLink > prevPage) {
            $('.pagination li:nth-child(3) a').text('...');
        }
        if (nextPageLink < nextPage) {
            $('.pagination li:nth-last-child(3) a').text('...');
        }
    });
</script>

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
        document.getElementById('audioArtist').innerHTML = artist;

        // for every button of class music-player-img, change the src to play image
        var allPlayBtns = document.querySelectorAll('.music-player-img');
        allPlayBtns.forEach(function(btn) {
            btn.setAttribute('src', "{{ asset('frontend-assets/image/1.png')}}");
            btn.setAttribute('onclick', 'playAudio("' + btn.getAttribute('data-file') + '", "' + btn.getAttribute('data-key') + '")');
        });

        // change the play button to pause button
        var playBtn = document.getElementById(file + '__' + key);
        playBtn.setAttribute('src', "{{ asset('frontend-assets/image/music-play-white-img.png')}}");
        playBtn.setAttribute('onclick', 'pauseAudio("' + file + '", "' + key + '")');
    }

    function pauseAudio(file, key) {

        var audioPlayer = document.getElementById('myAudioPlayer');
        audioPlayer.pause();
        var pauseBtn = document.getElementById(globalAudioSrc + '__' + globalKey);
        pauseBtn.setAttribute('src', "{{ asset('frontend-assets/image/1.png')}}");
        pauseBtn.setAttribute('onclick', 'playAudio("' + file + '", "' + key + '")');
    }

    // when user play or pause the audio, update the play button of the audio file
    var audioPlayer = document.getElementById('myAudioPlayer');
    audioPlayer.addEventListener('play', function() {
        var file = audioPlayer.src.split('/').pop();
        var btn = document.getElementById(globalAudioSrc + '__' + globalKey);
        btn.setAttribute('src', "{{ asset('frontend-assets/image/music-play-white-img.png')}}");
        btn.setAttribute('onclick', 'pauseAudio("' + btn.getAttribute('data-file') + '", "' + btn.getAttribute('data-key') + '")');
        // var allPlayBtns = document.querySelectorAll('.music-player-img');
        // allPlayBtns.forEach(function(btn) {
        //     if (btn.getAttribute('data-file') == file) {
        //         btn.setAttribute('src', "{{ asset('frontend-assets/image/music-play-white-img.png')}}");
        //         btn.setAttribute('onclick', 'pauseAudio("' + btn.getAttribute('data-file') + '", "' + btn.getAttribute('data-key') + '")');
        //     }
        // });
    });

    audioPlayer.addEventListener('pause', function() {
        var file = audioPlayer.src.split('/').pop();
        var btn = document.getElementById(globalAudioSrc + '__' + globalKey);
        btn.setAttribute('src', "{{ asset('frontend-assets/image/1.png')}}");
        btn.setAttribute('onclick', 'playAudio("' + btn.getAttribute('data-file') + '", "' + btn.getAttribute('data-key') + '")');
        // var allPlayBtns = document.querySelectorAll('.music-player-img');

        // allPlayBtns.forEach(function(btn) {
        //     if (btn.getAttribute('data-file') == file) {
        //         btn.setAttribute('src', "{{ asset('frontend-assets/image/1.png')}}");
        //         btn.setAttribute('onclick', 'playAudio("' + btn.getAttribute('data-file') + '", "' + btn.getAttribute('data-key') + '")');
        //     }
        // });
    });
</script>
<!-- Media Play JS End -->

<script>
    function toggleDropdown(type) {
        var dropdown = document.getElementById(type + "Dropdown");
        dropdown.classList.toggle("show");
    }

    // when user click on page get the value of page number and prevent the default behaviour
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        filterMusic(page);
    });

    function filterMusic(page = 1) {
        // search value
        var searchValue = document.getElementById('searchInput').value;

        // get all the checked values of artist
        var artistNames = '';
        var artistCheckboxes = document.querySelectorAll('input[name^="artist"]:checked');
        for (var i = 0; i < artistCheckboxes.length; i++) {
            artistNames += artistCheckboxes[i].value + ',';
        }

        // get all the checked values of genre
        var genreNames = '';
        var genreCheckboxes = document.querySelectorAll('input[name^="genre"]:checked');
        for (var i = 0; i < genreCheckboxes.length; i++) {
            genreNames += genreCheckboxes[i].value + ',';
        }

        // get all the checked values of tempo
        var tempoNames = '';
        var tempoCheckboxes = document.querySelectorAll('input[name^="tempo"]:checked');
        for (var i = 0; i < tempoCheckboxes.length; i++) {
            tempoNames += tempoCheckboxes[i].value + ',';
        }

        // get all the checked values of version
        var versionNames = '';
        var versionCheckboxes = document.querySelectorAll('input[name^="version"]:checked');
        for (var i = 0; i < versionCheckboxes.length; i++) {
            versionNames += versionCheckboxes[i].value + ',';
        }

        // check if query paramter has title
        var urlParams = new URLSearchParams(window.location.search);
        var title = urlParams.get('title');
        if (title == null) {
            title = '';
        }

        // reload the page with the with the search term and filter values
        window.location.href = "{{ route('frontend.music.search') }}?page=" + page + "&q=" + searchValue + "&title=" + searchValue + "&artist=" + artistNames + "&genre=" + genreNames + "&tempo=" + tempoNames + "&version=" + versionNames;
    }

    function gotoSearchPage(page = 1) {
        // search value
        var searchValue = document.getElementById('searchInput').value;

        // get all the checked values of artist
        var artistNames = '';
        var artistCheckboxes = document.querySelectorAll('input[name^="artist"]:checked');
        for (var i = 0; i < artistCheckboxes.length; i++) {
            artistNames += artistCheckboxes[i].value + ',';
        }

        // get all the checked values of genre
        var genreNames = '';
        var genreCheckboxes = document.querySelectorAll('input[name^="genre"]:checked');
        for (var i = 0; i < genreCheckboxes.length; i++) {
            genreNames += genreCheckboxes[i].value + ',';
        }

        // get all the checked values of tempo
        var tempoNames = '';
        var tempoCheckboxes = document.querySelectorAll('input[name^="tempo"]:checked');
        for (var i = 0; i < tempoCheckboxes.length; i++) {
            tempoNames += tempoCheckboxes[i].value + ',';
        }

        // get all the checked values of version
        var versionNames = '';
        var versionCheckboxes = document.querySelectorAll('input[name^="version"]:checked');
        for (var i = 0; i < versionCheckboxes.length; i++) {
            versionNames += versionCheckboxes[i].value + ',';
        }

        // check if query paramter has title
        var urlParams = new URLSearchParams(window.location.search);
        var title = urlParams.get('title');
        if (title == null) {
            title = '';
        }

        // reload the page with the with the search term and filter values
        window.location.href = "{{ route('frontend.music.search') }}?page=" + page + "&q=" + searchValue + "&title=" + '' + "&artist=" + artistNames + "&genre=" + genreNames + "&tempo=" + tempoNames + "&version=" + versionNames;
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

        $(document).on('click', '.search_result_item', function() {
            var searchResultItem = $(this).text();    
            var urlParams = new URLSearchParams(window.location.search);
            var artist = urlParams.get('artist') || '';
            var genre = urlParams.get('genre') || '';
            var tempo = urlParams.get('tempo') || '';
            var version = urlParams.get('version') || '';
            
            // Reload the page with the updated query parameters
            window.location.href = "{{ route('frontend.music.search') }}?q=" + searchResultItem + "&title=" + searchResultItem + "&artist=" + artist + "&genre=" + genre + "&tempo=" + tempo + "&version=" + version;
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
                    var urlParams = new URLSearchParams(window.location.search);
                    var artist = urlParams.get('artist') || '';
                    var genre = urlParams.get('genre') || '';
                    var tempo = urlParams.get('tempo') || '';
                    var version = urlParams.get('version') || '';

                    // Reload the page with the updated query parameters
                    window.location.href = "{{ route('frontend.music.search') }}?q=" + searchResultItem + "&title=" + searchResultItem + "&artist=" + artist + "&genre=" + genre + "&tempo=" + tempo + "&version=" + version;
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

</script>
@endsection
