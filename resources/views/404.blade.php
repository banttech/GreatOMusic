@extends('layouts.frontend.app')
@section('content')
    <style>
        .section_404 {
            background: url("{{ asset('admin-assets/images/404.jpg') }}");
            min-height: 300px;
            object-fit: cover;
            background-size: 100% 100%;
        }
        .width {
            width: 100%;
            background: #fff;
            padding: 50px 20px 50px 20px;
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
        
        .pink {
            color: #CC0066;
        }
        .pink:hover {
            color: #CC0066;
            border-bottom: 1px solid #CC0066;
        }
    </style>
    
    <div class="heading-section">
        <div class="" id="set">
            <div class="m-0">
                <div class="d-flex align-items-end section_404">
                    <div class="mainbgsblack" style="background-color: rgba(0, 0, 0, 0.8);width: 100%;">
                        <div class="container">
                            <div class="box-1 w-100">
                                <h2>Page Not Found</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="about-inbox">
        <div class="container">
            <div class="row">
                <div class="width">
                    <p class="jusrify">
                        Sorry, the page you are looking for has moved or no longer exists.<br>
                        Please click <a href="{{route('index')}}" class="pink">here</a> to visit the homepage.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
