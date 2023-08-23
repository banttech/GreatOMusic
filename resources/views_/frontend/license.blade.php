@extends('layouts.frontend.app')
@section('content')
<style>
    .licensing_section {
        background: url("{{ asset('admin-assets/images/license.jpg') }}");
        min-height: 300px;
        object-fit: cover;
        background-size: 100%;
    }

    .width {
        width: 100%;
        padding: 10px 20px 10px 20px;
        margin: 60px 0px 30px 0px;
        background: rgba(0, 0, 0, 0.4);
        font-size: 24px;
        color: #000;
        font-weight: 700;
    }

    .box-1 h2 {
        margin-left: -12px;
        font-size: 46px;
    }

    .mainbgsblack {
        border-bottom: 3px solid #CC0066;
        box-shadow: 0 7px 0 0px #000000;
    }

    .link:hover {
        text-decoration: underline !important;
    }

    #license_form {
        width: 100% !important;
    }

    .select-tag {
        background-color: rgba(0, 0, 0, 0.2) !important;
        border-radius: 0;
        padding: 10px 5px;
        width: 100% !important;
        color: #333 !important;
    }

    .select-tag option:not(:first-child) {
        text-align: left;
    }

    .form-input {
        background: rgba(0, 0, 0, 0.2) !important;
        border: 0px !important;
        border-radius: 0 !important;
        line-height: 35px;
        color: #333 !important;
        padding: 10px !important;
    }

    .not-allowed {
        cursor: not-allowed;
    }

    .preview_btn {
        background: #CC0066;
        color: #FFF !important;
        padding: 10px 25px !important;
        font-size: 18px;
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 600;
        border: 0px !important;
    }

    .preview_btn:hover {
        background: #CC0066;
        color: #FFF !important;
    }

    .preview_btn:focus {
        background: #CC0066 !important;
        color: #FFF !important;
    }

    .preview-label {
        width: 160px;
        margin: 0px;
    }

    .agree_to_terms input {
        cursor: pointer;
        width: 14px;
    }

    .agree_to_terms label {
        margin-left: 34px;
        margin-bottom: 0px;
    }

    .edit_btn {
        padding: 0.25rem 0.7rem !important;
        font-size: 0.875rem;
    }

    .edit_btn:hover {
        text-decoration: underline !important;
    }

    .modal-title {
        text-align: center;
        margin: 25px 0px 5px 0;
        font-family: inherit;
        font-weight: bold;
        /*line-height: 20px;*/
        color: inherit;
        text-rendering: optimizelegibility;
    }

    .modal-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        border-bottom: none;
        position: relative;
    }

    .modal-body {
        font-size: 15px;
    }

    .btn-close {
        position: absolute;
        right: 0;
        bottom: 0;
        margin: 10px !important;
    }

    .modal-centered {
        cursor: pointer;
    }

    .modal {
        background-color: rgba(255, 255, 255, 0.5) !important;
        animation: modalOpen 0.3s ease-in-out;
    }

    .modal-dialog {
        max-width: 1300px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        transform: scale(0.8);
        transition: transform 0.3s ease-in-out;
    }

    .modal-content {
        background-color: white;
        border: none;
        cursor: default;
    }

    .modal.show .modal-content {
        transform: scale(1);
    }

    @keyframes modalOpen {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .hr {
        border: none;
        height: 2px;
        background-color: black;
        /*margin-top: 27px;*/
        margin-top: -30px;
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

@if(!Auth::check())
<section class="">
    <div class="container" style="min-height: 380px;">
        <div class="row">
            <div class="width">
                <?php
                $file = request()->query('file');
                $cart_item = request()->query('cart_item');
                $music = App\Models\MusicTitle::where('id',$id)->first();
                ?>
                License Request: {{ $music->title }} | {{ $music->artist }}
            </div>
        </div>
        <p>You need to login first, please click <a href="{{ route('frontend.login', ['id'=>$id,'file' => $file, 'cart_item' => $cart_item]) }}" style="color:#cc0066;" class="link">Login</a> to account.</p>
        <p>If you do not have an have an account with us, please click <a href="{{ route('register') }}" style="color:#cc0066;" class="link">Sign Up</a> to create an account.</p>
    </div>
</section>
@else
<section class="">
    <div class="container" style="min-height: 380px;">
        <div class="row">
            <div class="width">
                <?php
                $file = request()->query('file');
                $cart_item = request()->query('cart_item');
                $music = App\Models\MusicTitle::where('id',$id)->first();
                ?>
                License Request: {{ $music->title }} | {{ $music->artist }}
            </div>
        </div>

        <?php
        $cart = App\Models\Cart::where('id', $cart_item)->first();
        ?>
        @if(!$cart->license || $cart->license == null)
        <div class="row">
            <?php
            $licenses = App\Models\License::select('name')
                ->distinct()
                ->orderBy('name', 'asc')
                ->get();
            ?>
            <form method="post" action="{{ route('frontend.cart.save.values', ['id' => $id,'file' => $file, 'cart_item' => $cart_item]) }}" id="license_form" novalidate="novalidate">
                @csrf
                <select id="license" name="license" class="valid select-tag" onchange="this.form.submit();">
                    <option value="" class="text-left">Choose A License</option>
                    @foreach($licenses as $license)
                    <option value="{{ $license->name }}">{{ $license->name }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        @elseif(!$cart->territory && $cart->territory == null)
        <div class="row">
            <?php
            $territories = App\Models\License::select('territory')
                ->where('name', $cart->license)
                ->distinct()
                ->orderBy('territory', 'asc')
                ->get();
            ?>
            <form method="post" action="{{ route('frontend.cart.save.values', ['id'=>$id,'file' => $file, 'cart_item' => $cart_item]) }}" id="license_form" novalidate="novalidate">
                @csrf
                <select id="territory" name="territory" class="valid select-tag" onchange="this.form.submit();">
                    <option value="" class="text-left">Choose A Territory</option>
                    @foreach($territories as $territory)
                    <option value="{{ $territory->territory }}">{{ $territory->territory }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        @elseif(!$cart->term && $cart->term == null)
        <div class="row">
            <?php
            $terms = App\Models\License::select('term')
                ->where('name', $cart->license)
                ->where('territory', $cart->territory)
                ->distinct()
                ->orderBy('term', 'asc')
                ->get();
            ?>
            <form method="post" action="{{ route('frontend.cart.save.values', ['id'=>$id,'file' => $file, 'cart_item' => $cart_item]) }}" id="license_form" novalidate="novalidate">
                @csrf
                <select id="term" name="term" class="valid select-tag" onchange="this.form.submit();">
                    <option value="" class="text-left">Choose A Term</option>
                    @foreach($terms as $term)
                    <option value="{{ $term->term }}">{{ $term->term }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        @elseif($cart->company_name == null || $cart->legal_name == null || $cart->address == null || $cart->project == null)
        <div class="row mb-5">
            <form class="w-100" method="post" action="{{ route('frontend.cart.save.company.info', ['id'=>$id,'file' => $file, 'cart_item' => $cart_item]) }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="company_name" class="form-control form-input" id="companyName" placeholder="Company Name">
                    @error('company_name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="legal_name" class="form-control form-input" id="fullName" placeholder="Name">
                    @error('legal_name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="address" class="form-control form-input" id="company" placeholder="Address">
                    @error('address')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="project" class="form-control form-input" id="project" placeholder="Project">
                    @error('project')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn" style="background:#CC0066;color:white;border-radius:20px;padding:4px 20px 7px 20px; margin-top:2px; border: none;">Preview Cart</button>
            </form>
        </div>
        @else
        <div class="row mb-5">
            <form class="w-100" method="post" action="{{ route('stripe-checkout', ['id'=>$id,'file' => $file, 'cart_item' => $cart_item]) }}" id="details_form">
                @csrf
                <div class="form-group d-flex justify-content-between align-items-center">
                    <label for="companyName" class="preview-label pl-3">Company Name</label>
                    <input type="text" name="" class="form-control form-input not-allowed" id="companyName" placeholder="Company Name" readonly value="{{ $cart->company_name }}">
                </div>
                <div class="form-group d-flex justify-content-between align-items-center">
                    <label for="fullName" class="preview-label pl-3">Name</label>
                    <input type="text" name="" class="form-control form-input not-allowed" id="fullName" placeholder="Name" readonly value="{{ $cart->legal_name }}">
                </div>
                <div class="form-group d-flex justify-content-between align-items-center">
                    <label for="company" class="preview-label pl-3">Address</label>
                    <input type="text" name="" class="form-control form-input not-allowed" id="company" placeholder="Address" readonly value="{{ $cart->address }}">
                </div>
                <div class="form-group d-flex justify-content-between align-items-center">
                    <label for="project" class="preview-label pl-3">Project</label>
                    <input type="text" name="" class="form-control form-input not-allowed" id="project" placeholder="Project" readonly value="{{ $cart->project }}">
                </div>
                <div class="form-group d-flex justify-content-between align-items-center">
                    <label for="title" class="preview-label pl-3">Title</label>
                    <input type="text" name="" class="form-control form-input not-allowed" id="title" placeholder="Title" readonly value="{{ $music->title }} | {{ $music->artist }}">
                </div>
                <div class="form-group d-flex justify-content-between align-items-center">
                    <label for="license" class="preview-label pl-3">License</label>
                    <input type="text" name="" class="form-control form-input not-allowed" id="license" placeholder="License" readonly value="{{ $cart->license }}">
                </div>
                <div class="form-group d-flex justify-content-between align-items-center">
                    <label for="territory" class="preview-label pl-3">Territory</label>
                    <input type="text" name="" class="form-control form-input not-allowed" id="territory" placeholder="Territory" readonly value="{{ $cart->territory }}">
                </div>
                <div class="form-group d-flex justify-content-between align-items-center">
                    <label for="term" class="preview-label pl-3">Term</label>
                    <input type="text" name="" class="form-control form-input not-allowed" id="term" placeholder="Term" readonly value="{{ $cart->term }}">
                </div>
                <div class="form-group d-flex justify-content-between align-items-center">
                    <label for="price" class="preview-label pl-3">Price</label>
                    <input type="text" name="" class="form-control form-input not-allowed" id="price" placeholder="Price" readonly value="${{ number_format($cart->price, 2) }}">
                </div>
                <!-- // license checkbox and edit button here -->
                <div class="form-group d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center agree_to_terms pl-3">
                        <input type="checkbox" name="" class="form-control form-input" id="license_agreement" value="">
                        <label for="submit">I have read and agree to the above license. <x style="color:#cc0066"><a class="inline cboxElement" style="color:#cc0066; cursor: pointer;" data-toggle="modal" data-target="#licenseModal">Click here</a></x> to preview {{ $cart->license }}. </label>
                    </div>
                    <div>
                        <button type="submit" class="btn" style="background:#CC0066;color:white;border-radius:20px;padding:4px 20px 7px 20px; margin-top:2px; border: none;">
                            <a href="{{ route('frontend.license.edit', ['id'=>$id,'file' => $file, 'cart_item' => $cart_item]) }}" style="color:#FFF;">Edit</a>
                        </button>
                    </div>
                </div>
                <label for="license" class="pl-3 mb-4" generated="true" id="licenseE" style="display: none; color: rgb(204, 0, 102); width: 100% !important;">You must agree to the license terms to purchase a license.</label>
                <div class="form-group">
                    <a onclick="purchaseLicense();" type="button" class="btn" style="background:#CC0066;color:white;border-radius:20px;padding:4px 20px 7px 20px; margin-top:2px; border: none;">Purchase License</a>
                    <a href="{{ route('frontend.cart') }}" type="button" class="btn ml-3" style="background:#CC0066;color:white;border-radius:20px;padding:4px 20px 7px 20px; margin-top:2px; border: none;">View Cart</a>
                </div>
            </form>
           <!-- Modal Start -->
            <div class="modal modal-centered" id="licenseModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title">{{ $cart->license }}</h1>
                            <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="max-height: 450px; overflow-y: scroll;">
                            <p class="text-center">
                                This agreement is for our master/sound recording only, you still will be required to obtain a license from the original publisher or copyright owner through harryfox.com
                            </p>
                            
                            <!--<table class="table table-borderless" style="font-size:15px; margin-top:1.80rem; margin-left:-0.1rem">
                                <tbody>
                                    <tr>
                                      <td style="width:155px; padding:0.30rem;">To :</td>
                                      <td style="padding:0.25rem;">{{ $cart->legal_name }}</td>
                                    </tr>
                                    <tr style="line-height:1.1">
                                      <td style="width:155px; padding:0.30rem;">Address :</td>
                                      <td style="padding:0.30rem;">{{ $cart->address }}</td>
                                    </tr>
                                    <tr style="line-height:1.3">
                                      <td style="width:155px; padding:0.30rem;">Date :</td>
                                      <td style="padding:0.30rem;">{{ date('m-d-Y') }}</td>
                                    </tr>
                                    <tr style="line-height:1.3">
                                      <td style="width:155px; vertical-align: top; padding:0.30rem;">Re :</td>
                                      <td style="padding:0.30rem;">Non-Exclusive License: "{{ $music->title }}", {{ $music->artist }}</td>
                                    </tr>
                              </tbody>
                            </table>-->
                            
                            <!--<table class="table table-borderless" style="font-size:15px; margin-top:1.80rem; margin-left:-0.1rem">
                                <tbody>
                                    <tr>
                                      <td style="width:155px; padding:0.30rem;">To :</td>
                                      <td style="padding:0.25rem; text-align:justify;">{{ $cart->legal_name }}</td>
                                    </tr>
                                    <tr style="line-height:0.1">
                                      <td style="width:155px; padding:0.30rem;">Address :</td>
                                      <td style="padding:0.30rem; text-align:justify;">{{ $cart->address }}</td>
                                    </tr>
                                    <tr style="line-height:1.3">
                                      <td style="width:155px; padding:0.30rem;">Date :</td>
                                      <td style="padding:0.30rem;">{{ date('m-d-Y') }}</td>
                                    </tr>
                                    <tr style="line-height:0.1">
                                      <td style="width:155px; vertical-align: top; padding:0.30rem;">Re :</td>
                                      <td style="padding:0.30rem; text-align:justify;">Non-Exclusive License: "{{ $music->title }}", {{ $music->artist }}</td>
                                    </tr>
                              </tbody>
                            </table>-->
                            
                            <table class="table table-borderless" style="font-size:15px; margin-top:1.80rem; margin-left:-0.1rem">
                                <tbody>
                                    <tr>
                                      <td style="width:155px; padding:0.30rem;">To :</td>
                                      <td style="padding:0.25rem; text-align:justify;">{{ $cart->legal_name }}</td>
                                    </tr>
                                    <tr style="position: relative; top: -0.6rem;">
                                      <td style="width:155px; padding:0.30rem;">Address :</td>
                                      <td style="padding:0.30rem; text-align:justify;">{{ $cart->address }}</td>
                                    </tr>
                                    <tr style="position: relative; top: -1.32rem;">
                                      <td style="width:155px; padding:0.30rem;">Date :</td>
                                      <td style="padding:0.30rem;">{{ date('m-d-Y') }}</td>
                                    </tr>
                                    <tr style="position: relative; top: -2.076em;">
                                      <td style="width:155px; vertical-align: top; padding:0.30rem;">Re :</td>
                                      <td style="padding:0.30rem; text-align:justify;">Non-Exclusive License: "{{ $music->title }}", {{ $music->artist }}</td>
                                    </tr>
                              </tbody>
                            </table>
                            
                            <hr class="hr">
                            
                            <p class="mb-4" style="text-align:justify; padding-bottom: 17px;">On behalf of Great "O" Music, we are pleased to make you the following offer to license our Title as set forth below:</p>
                            
                            <!--<table class="table table-borderless" style="font-size:15px; margin-top:1.80rem; margin-left:-0.1rem">
                                <tbody>
                                    <tr>
                                      <td style="width:155px; padding:0.30rem;">Licensee :</td>
                                      <td style="padding:0.25rem;">{{ $cart->legal_name }}, {{ $cart->company_name }}</td>
                                    </tr>
                                    <tr style="line-height:1.1">
                                      <td style="width:155px; padding:0.30rem;">Project :</td>
                                      <td style="padding:0.30rem;">{{ $cart->project }}</td>
                                    </tr>
                                    <tr style="line-height:1.3">
                                      <td style="width:155px; padding:0.30rem;">Title :</td>
                                      <td style="padding:0.30rem;">"{{ $music->title }}"</td>
                                    </tr>
                                    <tr style="line-height:1.3">
                                      <td style="width:155px; vertical-align: top; padding:0.30rem;">Rights :</td>
                                      <td style="padding:0.30rem;">Sound Recording Only (Cover Version) solely in sync with visual images. Non-Exclusive. No third party licensing granted.</td>
                                    </tr>
                                    
                                    <tr style="line-height:1.3">
                                      <td style="width:155px; vertical-align: top; padding:0.30rem;">Term :</td>
                                      <td style="padding:0.30rem;">{{ $cart->term }}</td>
                                    </tr>
                                    
                                    <tr style="line-height:1.3">
                                      <td style="width:155px; vertical-align: top; padding:0.30rem;">Territory :</td>
                                      <td style="padding:0.30rem;">{{ $cart->territory }}</td>
                                    </tr>
                                    
                                    <tr style="line-height:1.3">
                                      <td style="width:155px; vertical-align: top; padding:0.30rem;">Payment :</td>
                                      <td style="padding:0.30rem;">${{number_format($cart->price, 2)}} (USD)</td>
                                    </tr>
                                    
                                    <tr style="line-height:1.3">
                                      <td style="width:155px; vertical-align: top; padding:0.30rem;">Other Rights :</td>
                                      <td style="padding:0.30rem;">Great "O" Music shall receive proper credit in end credits on a most-favored nations basis with all other songs used in the Project.</td>
                                    </tr>
                              </tbody>
                            </table>-->
                            
                            <!--<table class="table table-borderless" style="font-size:15px; margin-top:1.80rem; margin-left:-0.1rem">
                                <tbody>
                                    <tr>
                                      <td style="width:155px; padding:0.30rem;">Licensee :</td>
                                      <td style="padding:0.25rem; text-align:justify;">{{ $cart->legal_name }}, {{ $cart->company_name }}</td>
                                    </tr>
                                    <tr style="line-height:0.1">
                                      <td style="width:155px; padding:0.30rem;">Project :</td>
                                      <td style="padding:0.30rem; text-align:justify;">{{ $cart->project }}</td>
                                    </tr>
                                    <tr style="line-height:1.5">
                                      <td style="width:155px; padding:0.30rem;">Title :</td>
                                      <td style="padding:0.30rem; text-align:justify;">"{{ $music->title }}"</td>
                                    </tr>
                                    <tr style="line-height:0.1">
                                      <td style="width:155px; vertical-align: top; padding:0.30rem;">Rights :</td>
                                      <td style="padding:0.30rem; text-align:justify;">Sound Recording Only (Cover Version) solely in sync with visual images. Non-Exclusive. No third party licensing granted.</td>
                                    </tr>
                                    
                                    <tr style="line-height:1.3">
                                      <td style="width:155px; vertical-align: top; padding:0.30rem;">Term :</td>
                                      <td style="padding:0.30rem;">{{ $cart->term }}</td>
                                    </tr>
                                    
                                    <tr style="line-height:0.1">
                                      <td style="width:155px; vertical-align: top; padding:0.30rem;">Territory :</td>
                                      <td style="padding:0.30rem;">{{ $cart->territory }}</td>
                                    </tr>
                                    
                                    <tr style="line-height:1.3">
                                      <td style="width:155px; vertical-align: top; padding:0.30rem;">Payment :</td>
                                      <td style="padding:0.30rem;">${{number_format($cart->price, 2)}} (USD)</td>
                                    </tr>
                                    
                                    <tr style="line-height:0.1">
                                      <td style="width:155px; vertical-align: top; padding:0.30rem;">Other Rights :</td>
                                      <td style="padding:0.30rem; text-align:justify;">Great "O" Music shall receive proper credit in end credits on a most-favored nations basis with all other songs used in the Project.</td>
                                    </tr>
                              </tbody>
                            </table>-->
                            
                            <table class="table table-borderless" style="font-size:15px; margin-top:1.80rem; margin-left:-0.1rem">
                                <tbody>
                                    <tr style="position: relative; top: -2.2rem;">
                                      <td style="width:155px; padding:0.30rem;">Licensee :</td>
                                      <td style="padding:0.25rem; text-align:justify;">{{ $cart->legal_name }}, {{ $cart->company_name }}</td>
                                    </tr>
                                    <tr style="position:relative; top:-2.8rem;">
                                      <td style="width:155px; padding:0.30rem;">Project :</td>
                                      <td style="padding:0.30rem; text-align:justify;">{{ $cart->project }}</td>
                                    </tr>
                                    <tr style="position:relative; top:-3.26rem;">
                                      <td style="width:155px; padding:0.30rem;">Title :</td>
                                      <td style="padding:0.30rem; text-align:justify;">"{{ $music->title }}"</td>
                                    </tr>
                                    <tr style="position:relative; top:-3.88rem;">
                                      <td style="width:155px; vertical-align: top; padding:0.30rem;">Rights :</td>
                                      <td style="padding:0.30rem; text-align:justify;">Sound Recording Only (Cover Version) solely in sync with visual images. Non-Exclusive. No third party licensing granted.</td>
                                    </tr>
                                    
                                    <tr style="position:relative; top:-4.40rem;">
                                      <td style="width:155px; vertical-align: top; padding:0.30rem;">Term :</td>
                                      <td style="padding:0.30rem;">{{ $cart->term }}</td>
                                    </tr>
                                    
                                    <tr style="position:relative; top:-4.92rem;">
                                      <td style="width:155px; vertical-align: top; padding:0.30rem;">Territory :</td>
                                      <td style="padding:0.30rem;">{{ $cart->territory }}</td>
                                    </tr>
                                    
                                    <tr style="position:relative; top:-5.46rem;">
                                      <td style="width:155px; vertical-align: top; padding:0.30rem;">Payment :</td>
                                      <td style="padding:0.30rem;">${{number_format($cart->price, 2)}} (USD)</td>
                                    </tr>
                                    
                                    <tr style="position:relative; top:-6.04rem;">
                                      <td style="width:155px; vertical-align: top; padding:0.30rem;">Other Rights :</td>
                                      <td style="padding:0.30rem; text-align:justify;">Great "O" Music shall receive proper credit in end credits on a most-favored nations basis with all other songs used in the Project.</td>
                                    </tr>
                              </tbody>
                            </table>
                            
                            
                            <p class="mt-4 mb-4" style="text-align:justify; position:relative; top:-5.46rem;">
                                Licensee is required to procure and retain all necessary agreements concerning the underlying musical composition embodied in the sound recording with any third party, and Licensee is solely responsible to make any and all payments in connection therewith.
                            </p>
                            <p class="mt-4 mb-4" style="text-align:justify; position:relative; top:-6.00rem;">
                                This License cannot be transferred or assigned by affirmative act or by operation of law without the express prior written consent of the undersigned in writing.
                            </p>
                            <p class="mt-4 mb-4" style="text-align:justify; position:relative; top:-6.50rem;">
                                This Agreement terminates and supersedes all prior understandings or agreements on the subject matter hereof. This Agreement may be modified only by a further writing that is duly executed by both parties.
                            </p>
                            <p class="mt-4 mb-4" style="text-align:justify; position:relative; top:-7.00rem;">
                                This Agreement is made and executed in the State of New York, and governed by the laws of New York. All parties hereto hereby consent to jurisdiction and venue exclusively in the Courts of the City and State of New York.
                            </p>
                            <p class="mt-4 mb-4" style="text-align:justify; position:relative; top:-7.60rem;">
                                Clicking "I have read and agree to the above license" will indicate your acceptance of the foregoing.
                            </p>
                            <p class="mb-0" style="position: relative; top: -8.1rem;">
                                Accepted and agreed to by:
                            </p>
                            <p class="mb-0" style="position: relative; top: -8.1rem;">
                                Licensor: Great "O" Music
                            </p>
                            <p class="mb-0" style="position: relative; top: -8.1rem;">
                                Authorized Representative
                            </p>
                            <p class="mb-0" style="position: relative; top: -8.1rem;">
                                Date: {{ date('m-d-Y') }}
                            </p>
                            <p class="mt-4 mb-0" style="position: relative; top: -8.1rem;">
                                Accepted and agreed to by:
                            </p>
                            <p class="mb-0" style="position: relative; top: -8.1rem;">
                                Licensee: {{ $cart->legal_name }}, {{ $cart->company_name }}
                            </p>
                            <p class="mb-0" style="position: relative; top: -8.1rem;">
                                Authorized Representative
                            </p>
                            <p class="mb-4" style="position: relative; top: -8.1rem;">
                                Date: {{ date('m-d-Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal End -->
        </div>
        @endif
    </div>
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#licenseModal">
        View License Details
    </button> -->
</section>
@endif

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    $(document).click(function(event) {
        var target = $(event.target);
        if (target.is('.modal')) {
            $('#licenseModal').modal('hide');
        }
    });

    $(window).on('resize', function() {
        centerModal();
    });

    $('#licenseModal').on('show.bs.modal', function() {
        centerModal();
    });

    function centerModal() {
        var $modal = $('#licenseModal');
        var $dialog = $modal.find('.modal-dialog');
        var windowHeight = $(window).height();
        var dialogHeight = $dialog.outerHeight();
        var marginTop = (windowHeight - dialogHeight) / 2;

        $dialog.css('margin-top', marginTop);
    }
</script>
<script>
    function purchaseLicense() {
        if (document.getElementById('license_agreement').checked) {
            var redirectURL = "{{ config('app.url') }}checkout?id={{ $id }}&file={{ $file }}&cart_item={{ $cart_item }}";
            window.location.href = redirectURL;
        } else {
            document.getElementById('licenseE').style.display = 'block';
        }
    }
</script>
@endsection