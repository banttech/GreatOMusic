<!DOCTYPE html>

<html>



<head>

    <style>

        /* Add your custom styles here */

        body {

            text-align: left;

            margin-left: 10px;
            
            margin-right: 10px;
            
            margin-top: 11px;
            
            /*font-family: Verdana, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"*/
            font-family: "DEJAVU SANS";
            
            font-size: 10pt;
        }



        h2 {

            font-size: 22px;

            margin-bottom: 10px;

        }



        p {

            margin-bottom: 5px;

        }



        .key {

            display: inline-block;

            width: 150px;

        }



        .text-center {

            text-align: center;

        }


        .invoice-para {

            margin-bottom: 25px;

        }

        .line {

            border: none;

            border-top: 1px solid black;

        }

        .invoice-header {

            position: relative;
            padding-top:0.85rem;
            font-weight:bold;
            font-size:1.6em;
            margin-left:-0.5rem;    
        }

    </style>

</head>



<body>

    <hr class="line" style="margin-left:0.05rem; margin-top:0.45rem; " />

    <h2 class="text-center invoice-header">{{ $license }}</h2>

    <!--<p class="text-center invoice-para" style="margin-left: -0.430rem; margin-top: 0.90rem; line-height: 0.8rem;">This agreement is for our master/sound recording only, you still will be required to obtain a license from the original publisher or copyright owner through harryfox.com or songclearance.com</p>-->
    <p class="text-center invoice-para" style="margin-left: -0.430rem; margin-top: 0.90rem; line-height: 0.8rem;">This agreement is for our master/sound recording only, you still will be required to obtain a license from the original publisher or copyright owner through harryfox.com</p>

    <!--<p class="invoice-para" style="margin-bottom: 0px; margin-left:0.08rem; margin-top: 2.10rem; line-height: 0.8rem; text-align:left;">
        <span class="key" style="float:left;">To :</span><span style="float:left; margin-left:0.5rem;">{{ $to }}</span>
    </p>

    <p class="invoice-para" style="margin-bottom: 0px; margin-left:0.08rem; margin-top: 1.05rem; line-height: 0.8rem; text-align:left;">
        <span class="key" style="float:left;">Address :</span><span style="float:left; margin-left:0.5rem;">{{ $address }}</span>
    </p>

    <p class="invoice-para" style="margin-bottom: 0px; margin-left:0.08rem; margin-top: 1.05rem; line-height: 0.8rem; text-align:left;">
        <span class="key" style="float:left;">Date :</span><span style="float:left; margin-left:0.5rem;">{{ date('m-d-Y', strtotime($date)) }}</span>
    </p>

    <p class="invoice-para" style="margin-bottom: 0px; margin-left:0.08rem; margin-top: 1.05rem; margin-right:150px; line-height: 0.8rem; text-align:left;">
        <span class="key" style="float:left;">Re :</span><span style="float:left; margin-left:0.5rem;">{{ $re }}</span>
    </p>-->
    
    <table class="table table-borderless" style="font-size:13px; margin-top:1.80rem; margin-left:-0.1rem">
        <tbody>
            <tr>
              <td style="width:155px;">To :</td>
              <td style="text-align:justify;">{{ $to }}</td>
            </tr>
            <tr style="line-height:0.6">
              <td style="width:155px;">Address :</td>
              <td style="text-align:justify;">{{ $address }}</td>
            </tr>
            <tr style="line-height:0.8">
              <td style="width:155px;">Date :</td>
              <td>{{ date('m-d-Y', strtotime($date)) }}</td>
            </tr>
            <tr style="line-height:0.8">
              <td style="width:155px; vertical-align: top;">Re :</td>
              <td style="text-align:justify;">{{ $re }}</td>
            </tr>
      </tbody>
    </table>
                

    <hr class="line" style="margin-top:1.2rem" />

    <p class="invoice-para" style="line-height: 0.81rem; margin-left: 0.1rem; margin-top:0.9rem; text-align:justify;">On behalf of Great "O" Music, we are pleased to make you the following offer to license our Title as set forth below:</p>

    <table class="table table-borderless" style="font-size:13px; margin-top:-0.9rem; margin-left:-0.1rem">
        <tbody>
            <tr>
              <td style="width:155px;">Licensee :</td>
              <td style="text-align:justify;">{{ $to }}, {{ $company_name }}</td>
            </tr>
            <tr style="line-height:0.6">
              <td style="width:155px;">Project :</td>
              <td style="text-align:justify;">{{ $project }}</td>
            </tr>
            <tr style="line-height:0.8">
              <td style="width:155px;">Title :</td>
              <td style="text-align:justify;">"{{ $title }}"</td>
            </tr>
            <tr style="line-height:0.8">
              <td style="width:155px; vertical-align: top;">Rights :</td>
              <td style="text-align:justify;">Sound Recording Only (Cover Version) Non-Exclusive. No third party licensing granted.</td>
            </tr>
            <tr style="line-height:0.8">
              <td style="width:155px;">Term :</td>
              <td>{{ $term }}</td>
            </tr>
            <tr style="line-height:0.8">
              <td style="width:155px;">Territory :</td>
              <td>{{ $territory }}</td>
            </tr>
            <tr style="line-height:0.8">
              <td style="width:155px;">Payment :</td>
              <td>${{ number_format($price, 2) }} (USD)</td>
            </tr>
            <tr style="line-height:0.8">
              <td style="width:155px; vertical-align: top;">Other Rights :</td>
              <td style="text-align:justify;">Great "O" Music shall receive proper credit on any and all liner notes, labels, CDs, single sleeves, including stickering and any print advertisements.</td>
            </tr>
      </tbody>
    </table>
    
    <!--<p class="invoice-para" style="margin-bottom: 0px; margin-left:0.08rem; margin-top: -0.2rem; line-height: 0.45rem; text-align:left;">
        <span class="key" style="float:left;">Licensee :</span><span style="float:left; margin-left:0.6rem;">{{ $to }}, {{ $company_name }}</span>
    </p>

    <p class="invoice-para" style="margin-bottom: 0px; margin-left:0.08rem; margin-top: 1.15rem; line-height: 0.45rem; text-align:left;">
        <span class="key" style="float:left;">Project :</span><span style="float:left; margin-left:0.6rem;">{{ $project }}</span>
    </p>

    <p class="invoice-para" style="margin-bottom: 0px; margin-left:0.08rem; margin-top: 1.15rem; line-height: 0.35rem; text-align:left;">
        <span class="key" style="float:left;">Title :</span><span style="float:left; margin-left:0.6rem;">"{{ $title }}"</span>
    </p>

    <p class="invoice-para" style="margin-bottom: 0px; margin-left:0.08rem; margin-top: 1.05rem; margin-right:150px; line-height: 0.45rem; text-align:left;">
        <span class="key" style="float:left;">Rights :</span><span style="float:left; margin-left:0.6rem;">Sound Recording Only (Cover Version) Non-Exclusive. No third party licensing granted.</span>
    </p>

    <p class="invoice-para" style="margin-bottom: 0px; margin-left:0.08rem; margin-top: 2.15rem; line-height: 0.45rem; text-align:left;">
        <span class="key" style="float:left;">Term :</span><span style="float:left; margin-left:0.6rem;">{{ $term }}</span>
    </p>

    <p class="invoice-para" style="margin-bottom: 0px; margin-left:0.08rem; margin-top: 1.15rem; line-height: 0.45rem; text-align:left;">
        <span class="key" style="float:left;">Territory :</span><span style="float:left; margin-left:0.6rem;">{{ $territory }}</span>
    </p>

    <p class="invoice-para" style="margin-bottom: 0px; margin-left:0.08rem; margin-top: 1.15rem; line-height: 0.45rem; text-align:left;">
        <span class="key" style="float:left;">Payment :</span><span style="float:left; margin-left:0.6rem;">${{ number_format($price, 2) }} (USD)</span>
    </p>

    <p class="invoice-para" style="margin-bottom: 0px; margin-left:0.08rem; margin-top: 1.05rem; margin-right:150px; line-height: 0.8rem; text-align:left;">
        <span class="key" style="float:left;">Other Rights :</span><span style="float:left; margin-left:0.6rem;">Great "O" Music shall receive proper credit on any and all liner notes, labels, CDs, single sleeves, including stickering and any print advertisements.</span>
    </p>-->

    <p class="invoice-para" style="margin-top:2.0rem; margin-left:0.12rem; line-height: 0.8rem; text-align:justify;">Licensee is required to procure and retain all necessary agreements concerning the underlying musical composition embodied in the sound recording with any third party, and Licensee is solely responsible to make any and all payments in connection therewith.</p>

    <p class="invoice-para" style="margin-top:-0.50rem; margin-left:0.12rem; line-height: 0.8rem; text-align:justify;">This License cannot be transferred or assigned by affirmative act or by operation of law without the express prior written consent of the undersigned in writing.</p>

    <p class="invoice-para" style="margin-top:-0.50rem; margin-left:0.12rem; line-height: 0.8rem; text-align:justify;">This Agreement terminates and supersedes all prior understandings or agreements on the subject matter hereof. This Agreement may be modified only by a further writing that is duly executed by both parties.</p>

    <p class="invoice-para" style="margin-top:-0.50rem; margin-left:0.12rem; line-height: 0.8rem; text-align:justify;">This Agreement is made and executed in the State of New York, and governed by the laws of New York. All parties hereto hereby consent to jurisdiction and venue exclusively in the Courts of the City and State of New York.</p>

    <p class="invoice-para" style="margin-top:-0.50rem; margin-left:0.12rem; line-height: 0.8rem; text-align:justify;">Clicking "I have read and agree to the above license" will indicate your acceptance of the foregoing.</p>

    <p class="invoice-para" style="margin-top:-0.75rem; margin-left:0.12rem;">Accepted and agreed to by:</p>

    <p class="invoice-para" style="margin-top:-1.80rem; margin-left:0.12rem;">Licensor: Great "O" Music</p>

    <p class="invoice-para" style="margin-top:-1.80rem; margin-left:0.12rem;">Authorized Representative</p>

    <p class="invoice-para mb-3" style="margin-top:-1.80rem; margin-left:0.12rem;">Date: {{ date('m-d-Y', strtotime($date)) }}</p>

    <p class="invoice-para" style="margin-top:-0.75rem; margin-left:0.12rem;">Accepted and agreed to by:</p>

    <p class="invoice-para" style="margin-top:-1.80rem; margin-left:0.12rem;">Licensee: {{ $to }}, {{ $company_name }}</p>

    <p class="invoice-para" style="margin-top:-1.80rem; margin-left:0.12rem;">Authorized Representative</p>

    <p class="invoice-para mb-5" style="margin-top:-1.80rem; margin-left:0.12rem;">Date: {{ date('m-d-Y', strtotime($date)) }}</p>

</body>



</html>
