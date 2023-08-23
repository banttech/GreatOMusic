@extends('layouts.frontend.app')

@section('content')

<style>

    body {

        text-align: left;

        /*margin-left: 10px;
        
        margin-right: 10px;
        
        margin-top: 11px;
        
        font-family: "Verdana";
        
        font-size: 10pt;*/
    }
    
    .about-inbox {
        font-family: "Verdana";
        font-size: 10pt;
    }
    
    .table td {
        padding:0px!important;
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

        padding: 50px 50px 6px 50px;

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



    .invoice-header {

        position: relative;
        padding-top:26px;

    }
    
    .invoice-header h2 {
        font-size: 22px;
        margin-bottom: 10px;
    }



    .download-link {

        position: absolute;

        top: -82px;

        left: 0;

        cursor: pointer;

    }



    .width h2 {

        font-size: 28px;

        margin-bottom: 15px;
        
        font-weight:bold;

    }



    .invoice-para {

        margin-bottom: 25px;
        font-size: 14px;

    }



    .key {

        display: inline-block;

        width: 150px;

    }



    .text-center {

        text-align: center;

    }



    .line {

        border: none;

        border-top: 1px solid black;

    }

</style>



<div class="heading-section">

    <div class="" id="set">

        <div class="m-0">

            <div class="d-flex align-items-end invoice_section">

                <div class="mainbgsblack" style="background-color: rgba(0, 0, 0, 0.8);width: 100%;">

                    <div class="container">

                        <div class="box-1 w-100">

                            <h2>Agreement</h2>

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
                
                <hr class="line" style="margin-left:0.05rem; margin-top:3.10rem; " />

                <div class="invoice-header">

                    <h2 class="text-center">{{ $license->license }}</h2>

                    <a class="download-link" href="{{ route('agreements.download', ['licenseId' => $license->random_id]) }}" data-toggle="tooltip" title="Download Agreement">

                        <img class="download-img" src="{{ asset('frontend-assets/image/download-img.png') }}" alt="download" height="40" width="40">

                    </a>

                </div>
                
            <!--<p class="text-center invoice-para" style="margin-left: -0.430rem; margin-top: 1.20rem; line-height: 1.2rem;">This agreement is for our master/sound recording only, you still will be required to obtain a license from the original publisher or copyright owner through harryfox.com or songclearance.com</p>-->
            <p class="text-center invoice-para" style="margin-left: -0.430rem; margin-top: 1.20rem; line-height: 1.2rem;">This agreement is for our master/sound recording only, you still will be required to obtain a license from the original publisher or copyright owner through harryfox.com</p>
                
               <table class="table table-borderless" style="font-size:14px; margin-top:2.20rem;">
                    <tbody>
                        <tr>
                          <td style="width:177px;">To :</td>
                          <td style="text-align:justify;">{{$license->legal_name}}</td>
                        </tr>
                        <tr style="margin-bottom: 0px;">
                          <td style="width:177px;">Address :</td>
                          <td style="text-align:justify;">{{ $license->address }}</td>
                        </tr>
                        <tr>
                          <td style="width:177px;">Date :</td>
                          <td>{{ date('m-d-Y', strtotime($payment->date)) }}</td>
                        </tr>
                        <tr>
                          <td style="width:177px;">Re :</td>
                          <td style="text-align:justify;">Non-Exclusive License: "{{ $track->title }}", {{ $track->artist }}</td>
                        </tr>
                  </tbody>
                </table>
                
                <!-- <p class="invoice-para" style="margin-bottom: 0px; margin-left:0.08rem; margin-top: 2.10rem; line-height: 0.8rem; text-align:left;">
                    <span class="key" style="float:left;">To :</span><span style="float:left; margin-left:1.7rem;">{{$payment->first_name }} {{$payment->last_name }}</span>
                </p>
    
                <p class="invoice-para" style="margin-bottom: 0px; margin-left:0.08rem; margin-top: 3.30rem; line-height: 0.8rem; text-align:left;">
                    <span class="key" style="float:left;">Address :</span><span style="float:left; margin-left:1.7rem;">{{ $license->address }}</span>
                </p>

                <p class="invoice-para" style="margin-bottom: 0px; margin-left:0.08rem; margin-top: 4.45rem; line-height: 0.8rem; text-align:left;">
                    <span class="key" style="float:left;">Date :</span><span style="float:left; margin-left:1.7rem;">{{ date('m-d-Y', strtotime($payment->date)) }}</span>
                </p>
                
                <p class="invoice-para" style="margin-bottom: 0px; margin-left:0.08rem; margin-top: 5.50rem; margin-right:150px; line-height: 0.8rem; text-align:left;">
                    <span class="key" style="float:left;">Re :</span><span style="float:left; margin-left:1.7rem; width:700px;">{{ $track->title }} | {{ $track->artist }}</span>
                </p> -->

                <!--<hr class="line" style="margin-top:7.90rem" />-->
                <hr class="line" style="margin-top:1.2rem;" />

                <p class="invoice-para" style="text-align:justify;">On behalf of Great "O" Music, we are pleased to make you the following offer to license our Title as set forth below:</p>
                
                <?php

                if($cart) {
                    $price = $cart->price;

                    if ($cart->coupon_code != null) {
    
                        $price = $cart->price - $cart->coupon_discount;
    
                    }
                } else {
                    $price = $license->price;
                }

                ?>
                
                <table class="table table-borderless" style="font-size:14px; margin-top:1.6rem;">
                    <tbody>
                        <tr>
                          <td style="width:177px;">Licensee :</td>
                          <td style="text-align:justify;">{{ $license->legal_name }}, {{ $license->company_name }}</td>
                        </tr>
                        <tr style="margin-bottom: 0px;">
                          <td style="width:177px;">Project :</td>
                          <td style="text-align:justify;">{{ $license->project }}</td>
                        </tr>
                        <tr>
                          <td style="width:177px;">Title :</td>
                          <td style="text-align:justify;">"{{ $track->title }}"</td>
                        </tr>
                        <tr>
                          <td style="width:177px;">Rights :</td>
                          <td style="text-align:justify;">Sound Recording Only (Cover Version) Non-Exclusive. No third party licensing granted.</td>
                        </tr>
                        <tr>
                          <td style="width:177px;">Term :</td>
                          <td>{{ $license->term }}</td>
                        </tr>
                        <tr>
                          <td style="width:177px;">Territory :</td>
                          <td>{{ $license->territory }}</td>
                        </tr>
                        
                        <tr>
                          <td style="width:177px;">Payment :</td>
                          <td>${{ number_format($price, 2) }} (USD)</td>
                        </tr>
                        <tr>
                          <td style="width:177px;">Other Rights :</td>
                          <td style="text-align:justify;">Great "O" Music shall receive proper credit on any and all liner notes, labels, CDs, single sleeves, including stickering and any print advertisements.</td>
                        </tr>
                  </tbody>
                </table>
    
                <!-- <p class="invoice-para" style="margin-bottom: 0px; margin-left:0.08rem; margin-top: -0.20rem; line-height: 0.8rem; text-align:left;">
                    <span class="key" style="float:left;">Licensee :</span><span style="float:left; margin-left:1.7rem;">{{ $license->license }}</span>
                </p>                

                <p class="invoice-para" style="margin-bottom: 0px; margin-left:0.08rem; margin-top: 2.76rem; line-height: 0.8rem; text-align:left;">
                    <span class="key" style="float:left;">Project :</span><span style="float:left; margin-left:1.7rem;">{{ $license->project }}</span>
                </p>
            
                <p class="invoice-para" style="margin-bottom: 0px; margin-left:0.08rem; margin-top: 4.00rem; line-height: 0.8rem; text-align:left;">
                    <span class="key" style="float:left;">Title :</span><span style="float:left; margin-left:1.7rem;">"{{ $track->title }}"</span>
                </p>
                
                <p class="invoice-para" style="margin-bottom: 0px; margin-left:0.08rem; margin-top: 5.20rem; margin-right:150px; line-height: 0.8rem; text-align:left;">
                    <span class="key" style="float:left;">Rights :</span><span style="float:left; margin-left:1.7rem; width:700px;">Sound Recording Only (Cover Version) Non-Exclusive. No third party licensing granted.</span>
                </p>
            
                <p class="invoice-para" style="margin-bottom: 0px; margin-left:0.08rem; margin-top: 6.35rem; line-height: 0.8rem; text-align:left;">
                    <span class="key" style="float:left;">Term :</span><span style="float:left; margin-left:1.7rem;">{{ $license->term }}</span>
                </p>
                
                <p class="invoice-para" style="margin-bottom: 0px; margin-left:0.08rem; margin-top: 7.60rem; line-height: 0.8rem; text-align:left;">
                    <span class="key" style="float:left;">Territory :</span><span style="float:left; margin-left:1.7rem;">{{ $license->territory }}</span>
                </p> -->
                

                <?php

                /*if($cart) {
                    $price = $cart->price;

                    if ($cart->coupon_code != null) {
    
                        $price = $cart->price - $cart->coupon_discount;
    
                    }
                } else {
                    $price = $license->price;
                }*/

                ?>
                
                <!-- <p class="invoice-para" style="margin-bottom: 0px; margin-left:0.08rem; margin-top: 8.90rem; line-height: 0.8rem; text-align:left;">
                    <span class="key" style="float:left;">Payment :</span><span style="float:left; margin-left:1.7rem;">${{ number_format($price, 2) }}</span>
                </p>

                <p class="invoice-para" style="margin-bottom: 0px; margin-left:0.08rem; margin-top: 10.01rem; margin-right:150px; line-height: 0.8rem; text-align:left;">
                    <span class="key" style="float:left;">Other Rights :</span>
                    <span style="float:left; margin-left:1.7rem; width:700px; line-height:1.10rem;">
                        Great "O" Music shall receive proper credit on any and all liner notes, labels, CDs, single sleeves, including stickering and any print advertisements.
                    </span>
                </p> -->
                
                <!-- <p class="invoice-para" style="margin-top:14.5rem; margin-left:0.12rem; line-height: 1.10rem;">Licensee is required to procure and retain all necessary agreements concerning the underlying musical composition embodied in the sound recording with any third party, and Licensee is solely responsible to make any and all payments in connection therewith.</p> -->
                <p class="invoice-para" style="margin-top:2.2rem; margin-left:0.12rem; line-height: 1.10rem; text-align:justify;">Licensee is required to procure and retain all necessary agreements concerning the underlying musical composition embodied in the sound recording with any third party, and Licensee is solely responsible to make any and all payments in connection therewith.</p>
                
                <p class="invoice-para" style="margin-top:-0.65rem; margin-left:0.12rem; line-height: 1.10rem; text-align:justify;">This License cannot be transferred or assigned by affirmative act or by operation of law without the express prior written consent of the undersigned in writing.</p>

                <p class="invoice-para" style="margin-top:-0.65rem; margin-left:0.12rem; line-height: 1.10rem; text-align:justify;">This Agreement terminates and supersedes all prior understandings or agreements on the subject matter hereof. This Agreement may be modified only by a further writing that is duly executed by both parties.</p>
            
                <p class="invoice-para" style="margin-top:-0.65rem; margin-left:0.12rem; line-height: 1.10rem; text-align:justify;">This Agreement is made and executed in the State of New York, and governed by the laws of New York. All parties hereto hereby consent to jurisdiction and venue exclusively in the Courts of the City and State of New York.</p>
            
                <p class="invoice-para" style="margin-top:-0.65rem; margin-left:0.12rem; line-height: 1.10rem; text-align:justify;">Clicking "I have read and agree to the above license" will indicate your acceptance of the foregoing.</p>
    
                <p class="invoice-para" style="margin-top:-0.45rem; margin-left:0.12rem; line-height: 1.40rem;">Accepted and agreed to by:</p>

                <p class="invoice-para" style="margin-top:-1.80rem; margin-left:0.12rem; line-height: 1.40rem;">Licensor: Great "O" Music</p>
            
                <p class="invoice-para" style="margin-top:-1.80rem; margin-left:0.12rem; line-height: 1.40rem;">Authorized Representative</p>
            
                <p class="invoice-para mb-3" style="margin-top:-1.80rem; margin-left:0.12rem; line-height: 1.40rem;">Date: {{ date('m-d-Y', strtotime($payment->date)) }}</p>
            
                <p class="invoice-para" style="margin-top: -0.10rem; margin-left:0.12rem; line-height: 1.40rem;">Accepted and agreed to by:</p>
            
                <p class="invoice-para" style="margin-top:-1.80rem; margin-left:0.12rem; line-height: 1.40rem;">Licensee: {{ $license->legal_name }}, {{ $license->company_name }}</p>
            
                <p class="invoice-para" style="margin-top:-1.80rem; margin-left:0.12rem; line-height: 1.40rem;">Authorized Representative</p>
            
                <p class="invoice-para mb-5" style="margin-top:-1.80rem; margin-left:0.12rem; line-height: 1.40rem;">Date: {{ date('m-d-Y', strtotime($payment->date)) }}</p>

            </div>

        </div>

    </div>

</section>





@endsection
