@extends('layouts.frontend.app')

@section('content')

<style>

    .about-inbox {
        font-family: Verdana;
    }

    .invoice_section {

        background: url("{{ asset('admin-assets/images/account-bg.jpg') }}");

        min-height: 300px;

        object-fit: cover;

        background-size: 100% 100%;

    }

    .width {

        width: 100%;

        background: #fff;

        padding: 25px 50px 50px 50px;

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



    .width h1 {

        font-size: 24px;

    }



    .invoice-header {

        position: relative;

    }



    .download-link {

        position: absolute;

        top: -32px;

        left: 0;

        cursor: pointer;

    }



    .invoice-para {

        font-size: 16px;

        margin-bottom: 0px;

        text-align: left;
        
        margin-left:-0.22rem;
        
        display: flex;
        
        color: #202020;

    }



    .key {

        display: inline-block;

        width: 135px;

    }



    .separator {

        display: inline-block;

        width: 10px;

    }
    
    .invoice-para-date {

            font-size: 16px;

            margin-bottom: -0.05rem;
            
            margin-top:0px;
            
            padding-top:0px;
            
            color: #202020;

        }

</style>



<div class="heading-section">

    <div class="" id="set">

        <div class="m-0">

            <div class="d-flex align-items-end invoice_section">

                <div class="mainbgsblack" style="background-color: rgba(0, 0, 0, 0.8);width: 100%;">

                    <div class="container">

                        <div class="box-1 w-100">

                            <h2>Invoice</h2>

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

                <div class="invoice-header">
                    
                    <p style="margin-top: 2.360rem; font-weight:bold; font-size:24px; text-align: center;">Great "O" Music</p>

                    <a class="download-link" href="{{ route('invoices.download', ['licenseId' => $license->random_id]) }}" data-toggle="tooltip" title="Download Invoice">
                        <img class="download-img" src="{{ asset('frontend-assets/image/downloadpdficon.png') }}" alt="download" height="40" width="40">
                    </a>

                </div>
                
                
                <p class="invoice-para-date" style="text-align: right; margin-right:-4px;">Date : <span>{{ date('m-d-Y', strtotime($license->date)) }}</span></p>

                <p class="invoice-para-date" style="text-align: right; margin-right:-4px;">Invoice No. : <span>{{ $license->id }}</span></p>
    
    
                <p class="invoice-para" style="padding-top:2.85rem;">
                    <span class="key" style="float:left;">Company Name</span><span style="float:left; margin-left: 1.05rem;">:</span><span style="float:left; margin-left: 1.25rem;">{{ $license->company_name }}</span>
                </p>
    
                <p class="invoice-para" style="padding-top:0.68rem;">
                    <span class="key" style="float:left;">Name</span><span style="float:left; margin-left: 1.05rem;">:</span><span style="float:left; margin-left: 1.25rem;">{{ $license->legal_name }}</span>
                </p>
                
                <p class="invoice-para" style="padding-top:0.60rem;">
                    <span class="key" style="float:left;">Address</span><span style="float:left; margin-left: 1.05rem;">:</span><span style="float:left; margin-left: 1.25rem;">{{ $license->address }}</span>
                </p>
                
                <p class="invoice-para" style="padding-top:0.68rem;">
                    <span class="key" style="float:left;">Project</span><span style="float:left; margin-left: 1.05rem;">:</span><span style="float:left; margin-left: 1.25rem;">{{ $license->project }}</span>
                </p>
                
                <?php

                $music = App\Models\MusicTitle::where('id', $license->track_id)->first();

                ?>
                
                <p class="invoice-para" style="padding-top:0.60rem;">
                    <span class="key" style="float:left;">Title</span><span style="float:left; margin-left: 1.05rem;">:</span><span style="float:left; margin-left: 1.25rem;">{{ $music->title }}</span>
                </p>
                
                <p class="invoice-para" style="padding-top:0.70rem;">
                    <span class="key" style="float:left;">License</span><span style="float:left; margin-left: 1.05rem;">:</span><span style="float:left; margin-left: 1.25rem;">{{ $license->license }}</span>
                </p>
                
                <p class="invoice-para" style="padding-top:0.62rem;">
                    <span class="key" style="float:left;">Territory</span><span style="float:left; margin-left: 1.05rem;">:</span><span style="float:left; margin-left: 1.25rem;">{{ $license->territory }}</span>
                </p>
                
                <p class="invoice-para" style="padding-top:0.68rem;">
                    <span class="key" style="float:left;">Term</span><span style="float:left; margin-left: 1.05rem;">:</span><span style="float:left; margin-left: 1.25rem;">{{ $license->term }}</span>
                </p>
                
                <?php

                $cart = App\Models\Cart::where('session_id', $license->session_id)->first();
                if($cart) {
                    $price = $cart->price;
                    if ($cart->coupon_code != null) {
                        $price = $cart->price - $cart->coupon_discount;
                    }
                } else {
                    $price = $license->price;
                }
                ?>
                
                <p class="invoice-para" style="padding-top:0.68rem;">
                    <span class="key" style="float:left;">Price</span><span style="float:left; margin-left: 1.05rem;">:</span><span style="float:left; margin-left: 1.25rem;">${{ number_format($price, 2) }} (USD)</span>
                </p>

            </div>

        </div>

    </div>

</section>





@endsection