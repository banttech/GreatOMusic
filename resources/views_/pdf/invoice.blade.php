<!DOCTYPE html>

<html>



<head>

    <style>

        /* Add your custom styles here */

        body {

            text-align: center;
            font-family: "Verdana";

        }



        h1 {

            font-size: 24px;

        }



        p {

            font-size: 16px;

            margin-bottom: 5px;

            text-align: left;

        }



        .key {

            display: inline-block;

            width: 125px;

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
        
        .invoice-para {

            font-size: 16px;

            margin-bottom: 0px;

            text-align: left;
            
            margin-left:-0.22rem;
            
            display: flex;
            justify-content: center;
            align-item:center;
            
            color: #202020;

        }


    </style>

</head>



<body>

    <p style="margin-top: 2.360rem; font-weight:bold; font-size:24px; text-align: center;">Great "O" Music</p>

    <p class="invoice-para-date" style="text-align: right; margin-right:-4px;">Date : <span>{{ date('m-d-Y', strtotime($date)) }}</span></p>

    <p class="invoice-para-date" style="text-align: right; margin-right:-4px;">Invoice No. : <span>{{ $invoiceNumber }}</span></p>

    

    <p class="invoice-para" style="padding-top:2.85rem;">
        <span class="key" style="float:left;">Company Name</span><span style="float:left; margin-left: 0.05rem;">:</span><span style="float:left; margin-left: 1.25rem;">{{ $companyName }}</span>
    </p>
    
    <p class="invoice-para" style="padding-top:0.68rem;">
        <span class="key" style="float:left;">Name</span><span style="float:left; margin-left: 0.05rem;">:</span><span style="float:left; margin-left: 1.25rem;">{{ $name }}</span>
    </p>
    
    <p class="invoice-para" style="padding-top:0.60rem;">
        <span class="key" style="float:left;">Address</span><span style="float:left; margin-left: 0.05rem;">:</span><span style="float:left; margin-left: 1.25rem;">{{ $address }}</span>
    </p>
    
    <p class="invoice-para" style="padding-top:0.68rem;">
        <span class="key" style="float:left;">Project</span><span style="float:left; margin-left: 0.05rem;">:</span><span style="float:left; margin-left: 1.25rem;">{{ $project }}</span>
    </p>
    
    <p class="invoice-para" style="padding-top:0.60rem;">
        <span class="key" style="float:left;">Title</span><span style="float:left; margin-left: 0.05rem;">:</span><span style="float:left; margin-left: 1.25rem;">{{ $title }}</span>
    </p>
    
    <p class="invoice-para" style="padding-top:0.70rem;">
        <span class="key" style="float:left;">License</span><span style="float:left; margin-left: 0.05rem;">:</span><span style="float:left; margin-left: 1.25rem;">{{ $license }}</span>
    </p>
    
    <p class="invoice-para" style="padding-top:0.62rem;">
        <span class="key" style="float:left;">Territory</span><span style="float:left; margin-left: 0.05rem;">:</span><span style="float:left; margin-left: 1.25rem;">{{ $territory }}</span>
    </p>
    
    <p class="invoice-para" style="padding-top:0.68rem;">
        <span class="key" style="float:left;">Term</span><span style="float:left; margin-left: 0.05rem;">:</span><span style="float:left; margin-left: 1.25rem;">{{ $term }}</span>
    </p>
    
    <p class="invoice-para" style="padding-top:0.68rem;">
        <span class="key" style="float:left;">Price</span><span style="float:left; margin-left: 0.05rem;">:</span><span style="float:left; margin-left: 1.25rem;">${{ number_format($price, 2) }} (USD)</span>
    </p>

</body>



</html>