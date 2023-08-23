@extends('layouts.frontend.app')
@section('content')
    <style>
        .about_section {
            background: url("{{ asset('admin-assets/images/account-bg.jpg') }}");
            min-height: 300px;
            object-fit: cover;
            background-size: 100%;
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
        .box-1 h2{
            margin-left: -12px;
            font-size: 46px;
        }
        .mainbgsblack{
           border-bottom: 3px solid #CC0066;
           box-shadow: 0 7px 0 0px #000000;
        }
    </style>
    
    <div class="heading-section">
        <div class="" id="set">
            <div class="m-0">
                <div class="d-flex align-items-end about_section">
                    <div class="mainbgsblack" style="background-color: rgba(0, 0, 0, 0.8);width: 100%;">
                        <div class="container">
                            <div class="box-1 w-100">
                                <h2>Forgot Password</h2>
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
                <div class="width edit_div mb-3">
                    <h2>Forgot Password</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="about-inbox">
        <div class="container">
            <div class="row">
                @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 100%;">
                        <strong>{{ session('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="width mt-0">
                    <form class="mb-3" method="POST" action="{{ route('frontend.forgot') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email<span class="text-danger" style="font-size: 16px;">*</span></label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" autofocus="">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn" type="submit" style="background:#CC0066;color:white;border-radius:20px;padding:4px 20px 7px 20px; margin-top:2px; border: none;">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection