@extends('layouts.frontend.app')
@section('content')
<style>
    .licensing_section {
        /* background: url("{{ asset('admin-assets/images/cart-bg.jpg') }}"); */
        background: url("{{ asset('admin-assets/images/license-image.jpg') }}");
        min-height: 300px;
        object-fit: cover;
        background-size: 100% 100%;
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

    .edit_img,
    .remove_img,
    .cross_img {
        width: 30px;
    }
</style>

<div class="heading-section">
    <div class="" id="set">
        <div class="m-0">
            <div class="d-flex align-items-end licensing_section">
                <div class="mainbgsblack" style="background-color: rgba(0, 0, 0, 0.8);width: 100%;">
                    <div class="container">
                        <div class="box-1 w-100">
                            <h2>Cart</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="">
    <div class="container">
        <div class="row">
            <div class="width">
                @if (session('success'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <table class="table table-bordered mt-4">
                    <thead class="table-header">
                        <tr>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Edit</th>
                            <th>Remove</th>
                            <th>Purchase</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        <?php $totalPrice = 0.00; ?>
                        @if($cart_items && (count($cart_items) > 0))
                        @foreach($cart_items as $cart_item)
                        <tr>
                            <td>
                                <?php $music = App\Models\MusicTitle::where('id', $cart_item->track_id)->first(); ?>
                                <span class="track">
                                    <strong>{{ $music->title }} | {{ $music->artist }}</strong>
                                </span>
                                <br>
                                <span class="small-size"><strong class="medium-size">License:</strong> {{ $cart_item->license ? $cart_item->license : '---' }}</span> <strong> | </strong>
                                <span class="small-size"><strong class="medium-size">Territory:</strong> {{ $cart_item->territory ? $cart_item->territory : '---' }}</span> <strong> | </strong>
                                <span class="small-size"><strong class="medium-size">Term:</strong> {{ $cart_item->term ? $cart_item->term : '---' }}</span><br>
                                <span class="small-size"><strong class="medium-size">Company Name:</strong> {{ $cart_item->company_name ? $cart_item->company_name : '---' }}</span> <strong> | </strong>
                                <span class="small-size"><strong class="medium-size">Name:</strong> {{ $cart_item->legal_name ? $cart_item->legal_name : '---' }}</span> <strong> | </strong>
                                <span class="small-size"><strong class="medium-size">Address:</strong> {{ $cart_item->address ? $cart_item->address : '---' }}</span> <strong> | </strong>
                                <span class="small-size"><strong class="medium-size">Project:</strong> {{ $cart_item->project ? $cart_item->project : '---' }}</span>
                            </td>
                            <td class="text-center">
                                <?php $totalPrice += $cart_item->price;     ?>
                                {{ $cart_item->price ? '$'.number_format($cart_item->price, 2) : '-' }}
                            </td>
                            <td class="text-center">
                                <?php
                                $file = pathinfo($music->file, PATHINFO_FILENAME);
                                ?>
                                <a href="{{ route('frontend.license', ['id' => $music->id,'file' => $file, 'cart_item' => $cart_item->id]) }}">
                                    <img class="edit_img" src="{{ asset('frontend-assets/image/edit.png') }}" alt="edit">
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('frontend.cart.remove.item', $cart_item->id) }}">
                                    <img class="edit_img" src="{{ asset('frontend-assets/image/cross.png') }}" alt="edit">
                                </a>
                            </td>
                            <td class="text-center">
                                @if($cart_item->license && $cart_item->territory && $cart_item->term && $cart_item->company_name && $cart_item->legal_name && $cart_item->address && $cart_item->project)
                                <a href="{{ route('frontend.license', ['id' => $music->id,'file' => $file, 'cart_item' => $cart_item->id]) }}">
                                    <img class="edit_img" src="{{ asset('frontend-assets/image/cart-pink.png') }}" alt="edit" title="Purchase">
                                </a>
                                @else
                                <img class="edit_img" src="{{ asset('frontend-assets/image/cart-black.png') }}" alt="edit" title="Incomplete Details">
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">
                                <div class="w-100 d-flex justify-content-between align-items-center tbl_footer_area">
                                    <h2 class="cart_heading">Cart Total</h2>
                                    <strong>
                                        <span class="amount">${{ number_format($totalPrice, 2) }}</span>
                                    </strong>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection