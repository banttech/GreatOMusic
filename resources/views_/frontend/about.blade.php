@extends('layouts.frontend.app')
@section('content')
    <style>
        .about_section {
            background: url("{{ asset('admin-assets/images/'.$aboutContent->headerimg) }}");
            min-height: 300px;
            object-fit: cover;
            background-size: 100% 100%;
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
        
        @media screen and (max-width: 768px) {
            .active_link {
                width: 70px;
            }
        }
    
    </style>
    
    <div class="heading-section">
        <div class="" id="set">
            <div class="m-0">
                <div class="d-flex align-items-end about_section">
                    <div class="mainbgsblack" style="background-color: rgba(0, 0, 0, 0.8);width: 100%;">
                        <div class="container">
                            <div class="box-1 w-100">
                                <h2>About</h2>
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
                    {!! $aboutContent->text !!}
                </div>
            </div>
        </div>
    </section>
@endsection