@extends('layouts.frontend.app')
@section('content')
    <style>
        .licensing_section {
            background: url("{{ asset('admin-assets/images/'.$licenseContent->headerimg) }}");
            min-height: 300px;
            object-fit: cover;
            background-size: 100%;
        }
        
        .width {
            width: 100%;
            background: #fff;
            padding: 50px 20px 50px 20px;
            margin: 60px 0px;
        }
    </style>

    <div class="heading-section">
        <div class="" id="set">
            <div class="m-0">
                <div class="d-flex align-items-end licensing_section">
                    <div class="mainbgsblack" style="background-color: rgba(0, 0, 0, 0.8);width: 100%;">
                        <div class="container">
                            <div class="box-1 w-100">
                                <h2>Licensing</h2>
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
                    {!! $licenseContent->text !!}
                </div>
            </div>
        </div>
    </section>
@endsection