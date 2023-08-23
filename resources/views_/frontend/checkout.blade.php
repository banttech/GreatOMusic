@extends('layouts.frontend.app')

@section('content')

<style>

    .checkout_section {

        /* background: url("{{ asset('admin-assets/images/cart-bg.jpg') }}"); */

        background: url("{{ asset('admin-assets/images/license-image.jpg') }}");

        min-height: 300px;

        object-fit: cover;

        background-size: 100%;

    }

    .width {
        width: 100%;
        padding: 25px 20px 6px 20px;
    }

    .box-1 h2 {
        margin-left: -12px;
        font-size: 46px;
    }

    .mainbgsblack {
        border-bottom: 3px solid #CC0066;
        box-shadow: 0 7px 0 0px #000000;
    }

    .table-header {
        background-color: black;
        color: white;
    }

    .table-body,
    tfoot {
        background-color: rgba(0, 0, 0, 0.2);
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid black;
        vertical-align: middle;
    }

    .tbl_footer_area {
        background: #9F9F9E;
        padding: 10px;
        border: 1px solid #191919;
    }

    .tbl_footer_area .cart_heading {
        /*font-family: 'Raleway';
        font-weight: 500;*/
        font-weight:bolder;
        font-size: 20px;
        color: #000;
        margin: 0px;
    }

    strong.medium-size {
        font-size: 14px;
    }

    .small-size {
        font-size: 14px;
    }



    /* .width {

        width: 100%;

        background: #fff;

        padding: 0px 20px 10px 20px;

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



    .checkout_heading {

        border-bottom: 2px solid #000;

    }



    .hr {

        border: 1px solid #000;

    } */

</style>



<div class="heading-section">

    <div class="" id="set">

        <div class="m-0">

            <div class="d-flex align-items-end checkout_section">

                <div class="mainbgsblack" style="background-color: rgba(0, 0, 0, 0.8);width: 100%;">

                    <div class="container">

                        <div class="box-1 w-100">

                            <h2>Checkout</h2>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



@if(!Auth::check())

<section class="">

    <div class="container" style="min-height: 380px;">

        <div class="row">

            <div class="width">

                <?php

                $file = request()->query('file');

                $cart_item = request()->query('cart_item');

                $music = App\Models\MusicTitle::where('file', $file . '.mp3')->first();

                ?>

                License Request: {{ $music->title }} | {{ $music->artist }}

            </div>

        </div>

        <p>You need to login first, please click <a href="{{ route('frontend.login', ['file' => $file, 'cart_item' => $cart_item]) }}" style="color:#cc0066;" class="link">Login</a> to account.</p>

        <p>If you do not have an have an account with us, please click <a href="{{ route('register') }}" style="color:#cc0066;" class="link">Sign Up</a> to create an account.</p>

    </div>

</section>

@else

<?php
$id = request()->query('id');
$file = request()->query('file');

$cart_item = request()->query('cart_item');

$cart = App\Models\Cart::where('id', $cart_item)->first();

$music = App\Models\MusicTitle::where('id', $id)->first();

?>

<section class="">

    <div class="container">
        <div class="row">
            <div class="width">
                <table class="table table-bordered mt-4">
                    <thead class="table-header">
                        <tr>
                            <th>Description</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        <tr>
                            <td>
                                <span class="track">
                                    <strong>{{ $music->title }} | {{ $music->artist }}</strong>
                                </span>
                                <br>
                                <span class="small-size"><strong class="medium-size">License:</strong> {{ $cart->license ? $cart->license : '---' }}</span> <strong> | </strong>
                                <span class="small-size"><strong class="medium-size">Territory:</strong> {{ $cart->territory ? $cart->territory : '---' }}</span> <strong> | </strong>
                                <span class="small-size"><strong class="medium-size">Term:</strong> {{ $cart->term ? $cart->term : '---' }}</span> <strong> | </strong>
                                <span class="small-size"><strong class="medium-size">Project:</strong> {{ $cart->project ? $cart->project : '---' }}</span>
                            </td>
                            <td class="text-center">
                                {{ $cart->price ? '$'.number_format($cart->price, 2) : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="track d-flex align-items-center">
                                    <strong for="coupon-code" class="form-label" style="width: 120px;">Coupon Code:</strong>
                                    <div class="mr-2" style="width: 50%; margin-left: 20px; position: relative;">
                                        <input type="text" class="form-control" id="coupon-code" placeholder="Enter Coupon Code" value="{{ $cart->coupon_code ? $cart->coupon_code : '' }}" style="border: 1px solid #191919; border-radius: 0px; padding: 10px;">
                                    </div>
                                    <button type="button" class="btn btn-primary" id="apply-coupon" style="border: none; background:#CC0066;color:white;border-radius:20px;padding:4px 20px 7px 20px; margin-top:2px; display: {{ $cart->coupon_discount ? 'none' : 'block' }};" onclick="applyCoupon();">Apply</button>
                                    <button type="button" class="btn btn-primary" id="coupon_discount_remove" style="border: none; background:#CC0066;color:white;border-radius:20px;padding:4px 20px 7px 20px; margin-top:2px; display: {{ !$cart->coupon_discount ? 'none' : 'block' }};" onclick="removeCooupon();">Remove</button>
                                </span>
                                <div style="margin-left: 144px;">
                                    <span id="error-message" class="text-danger"></span>
                                    <span id="success-message" class="text-success"></span>
                                </div>
                            </td>
                            <td class="text-center">
                                <p id="coupon_discount">{{ $cart->coupon_discount ? '- $'.number_format($cart->coupon_discount, 2) : '' }}</p>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <?php
                            $grand_total = $cart->price;
                            if ($cart->coupon_discount && $cart->coupon_discount > 0) {
                                $grand_total = $cart->price - $cart->coupon_discount;
                            }
                        ?>
                        <input type="hidden" name="" id="grand__total" value="{{$grand_total}}">
                        <tr>
                            <td colspan="5">
                                <div class="w-100 d-flex justify-content-between align-items-center tbl_footer_area">
                                    <h2 class="cart_heading">Checkout Total</h2>
                                    <strong>
                                        <span class="amount" id="grand_total">${{ number_format($grand_total, 2) }}</span>
                                    </strong>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <div class="form-row d-flex mt-4 mb-4">
                    <button type="button" class="btn btn-primary mx-2" id="payButton" style="border: none; background:#CC0066;color:white;border-radius:20px;padding:4px 20px 7px 20px; margin-top:2px;" onclick="acceptRequest();">Purchase</button>

                    <a href="{{ route('frontend.cart') }}" type=" button" class="btn btn-primary mx-2" style="border: none; background:#CC0066;color:white;border-radius:20px;padding:4px 20px 7px 20px; margin-top:2px;">Save</a>

                </div>
            </div>
        </div>
    </div>



    <!-- Payment Form -->

    <form method="post" action="{{ route('stripe-checkout', ['file' => $file, 'cart_item' => $cart_item]) }}" id="payment-form" class="d-none">

        {{ csrf_field() }}

        <div class="form-row">

            <label for="card-element">

                Credit or debit card

            </label>

            <div id="card-element">

                <!-- A Stripe Element will be inserted here. -->

            </div>



            <!-- Used to display Element errors. -->

            <div id="card-errors" role="alert"></div>

        </div>



        <button type="submit">Submit Payment</button>

    </form>



    <script src="https://checkout.stripe.com/checkout.js"></script>

</section>

@endif



<script>

    function applyCoupon() {
        var couponCode = document.getElementById('coupon-code').value;
        // if coupon code is empty then return and show error message
        if (couponCode == '') {
            document.getElementById('error-message').innerHTML = 'Please enter coupon code.';
            return;
        }

        // Clear any previous error messages
        document.getElementById('error-message').innerHTML = '';
        document.getElementById('success-message').innerHTML = '';
        // disable apply coupon button
        document.getElementById('apply-coupon').disabled = true;
        var cartId = <?php echo $cart_item; ?>;

        var token = "{{ csrf_token() }}";

        fetch('/apply-coupon', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },

                body: JSON.stringify({
                    coupon: couponCode,
                    _token: token,
                    cart_item: cartId
                })

            })

            .then(function(response) {
                return response.json();
            })

            .then(function(data) {
                if (data.res_status === 'success') {
                    document.getElementById('success-message').innerHTML = '';
                    document.getElementById('error-message').innerHTML = '';
                    document.getElementById('success-message').innerHTML = data.message;

                    document.getElementById('apply-coupon').style.display = 'none';
                    document.getElementById('coupon_discount_remove').style.display = 'block';

                    if (typeof data.coupon_discount === 'number') {
                        document.getElementById('coupon_discount').innerHTML = '- $' + data.coupon_discount.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    } else {
                        var couponDiscount = Number(data.coupon_discount);
                        if (!isNaN(couponDiscount)) {
                            document.getElementById('coupon_discount').innerHTML = '- $' + couponDiscount.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        } else {
                            document.getElementById('coupon_discount').innerHTML = 'N/A';
                        }
                    }

                    if (typeof data.grand_total === 'number') {
                    document.getElementById('grand_total').innerHTML = '$' + data.grand_total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    } else {
                        var grandTotal = Number(data.grand_total);
                        if (!isNaN(grandTotal)) {
                            document.getElementById('grand_total').innerHTML = '$' + grandTotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        } else {
                            document.getElementById('grand_total').innerHTML = 'N/A';
                        }
                    }

                    // set grand total in hidden field
                    document.getElementById('grand__total').value = data.grand_total;

                } else if (data.res_status === 'already_used') {
                    document.getElementById('success-message').innerHTML = '';
                    document.getElementById('error-message').innerHTML = '';
                    document.getElementById('error-message').innerHTML = data.message;

                } else {
                    document.getElementById('success-message').innerHTML = '';
                    document.getElementById('error-message').innerHTML = '';
                    document.getElementById('error-message').innerHTML = data.message;
                }

                // enable apply coupon button
                document.getElementById('apply-coupon').disabled = false;

            })
            .catch(function(error) {
                document.getElementById('error-message').innerHTML = 'Something went wrong. Please try again.';
                // enable apply coupon button
                document.getElementById('apply-coupon').disabled = false;
            });
    }

    function removeCooupon() {
        // first alert the user to confirm if he/she wants to remove coupon discount
        var r = confirm("Are you sure you want to remove coupon discount?");
        if(r == false) {
            return;
        }
        // if user confirms then remove coupon discount
        document.getElementById('coupon_discount_remove').disabled = true;
        var cartId = <?php echo $cart_item; ?>;
        var token = "{{ csrf_token() }}";

        fetch('/remove-coupon', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },

                body: JSON.stringify({
                    _token: token,
                    cart_item: cartId
                })

            })

            .then(function(response) {
                return response.json();
            })

            .then(function(data) {
                if (data.res_status === 'success') {
                    document.getElementById('success-message').innerHTML = '';
                    document.getElementById('error-message').innerHTML = '';
                    alert(data.message);
                    
                    document.getElementById('apply-coupon').style.display = 'block';
                    document.getElementById('coupon_discount_remove').style.display = 'none';

                    if (typeof data.grand_total === 'number') {
                     document.getElementById('grand_total').innerHTML = '$' + data.grand_total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    } else {
                        var grandTotal = Number(data.grand_total);
                        if (!isNaN(grandTotal)) {
                            document.getElementById('grand_total').innerHTML = '$' + grandTotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        } else {
                            document.getElementById('grand_total').innerHTML = 'N/A';
                        }
                    }

                    // empty the coupon-code input field
                    document.getElementById('coupon-code').value = '';
                    document.getElementById('coupon_discount').textContent = '';
                    document.getElementById('grand__total').value = data.grand_total;

                } else {
                    document.getElementById('success-message').innerHTML = '';
                    document.getElementById('error-message').innerHTML = '';
                    document.getElementById('error-message').innerHTML = data.message;

                }

                document.getElementById('coupon_discount_remove').disabled = false;
            })

            .catch(function(error) {
                document.getElementById('error-message').innerHTML = 'Something went wrong. Please try again.';
                document.getElementById('coupon_discount_remove').disabled = false;
            });
    }


    function acceptRequest() {

        var totralPrice = document.getElementById('grand__total').value;

        // disable the button to prevent multiple clicks
        document.getElementById('payButton').disabled = true;
        var handler = StripeCheckout.configure({

            key: "{{ env('STRIPE_PUBLIC_KEY') }}",

            image: 'https://stripe.com/img/documentation/checkout/marketplace.png',

            locale: 'auto',

            token: function(token) {

                var form = document.getElementById('payment-form');

                var tokenInput = document.createElement('input');

                tokenInput.type = 'hidden';

                tokenInput.name = 'stripeToken';

                tokenInput.value = token.id;

                form.appendChild(tokenInput);

                form.submit();

            }

        });

        handler.open({
            name: 'Great “O” Music',
            description: 'Pay Now',
            amount: totralPrice * 100,
            currency: 'usd',
        });



        $(document).on("DOMNodeRemoved", ".stripe_checkout_app", close);

        function close() {
            document.getElementById('payButton').disabled = false;
        }

    }

</script>

@endsection