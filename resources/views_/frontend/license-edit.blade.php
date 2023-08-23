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
        width: 100% !important;
        padding: 10px 20px 10px 20px !important;
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

<section class="">
    <div class="container" style="min-height: 380px;">
        <div class="row">
            <div class="width">
                <?php
                $file = request()->query('file');
                $cart_item = request()->query('cart_item');
                $id = request()->query('id');
                $music = App\Models\MusicTitle::where('file', $file . '.mp3')->first();
                ?>
                License Request: {{ $music->title }} | {{ $music->artist }}
            </div>
        </div>
        <div class="row mb-5">
            <form class="w-100" id="license_form" method="POST" action="{{ route('frontend.update.license', ['id' => $id,'file' => $file, 'cart_item' => $cart_item]) }}">
                @csrf
                <div class="form-group d-flex justify-content-between align-items-center">
                    <label for="companyName" class="preview-label">Company Name</label>
                    <div class="w-100">
                        <input type="text" name="company_name" class="form-control form-input" id="companyName" placeholder="Company Name" value="{{ $cart->company_name }}">
                        @error('company_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group d-flex justify-content-between align-items-center">
                    <label for="fullName" class="preview-label">Name</label>
                    <div class="w-100">
                        <input type="text" name="legal_name" class="form-control form-input" id="fullName" placeholder="Name" value="{{ $cart->legal_name }}">
                        @error('legal_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group d-flex justify-content-between align-items-center">
                    <label for="company" class="preview-label">Address</label>
                    <div class="w-100">
                        <input type="text" name="address" class="form-control form-input" id="company" placeholder="Address" value="{{ $cart->address }}">
                        @error('address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group d-flex justify-content-between align-items-center">
                    <label for="project" class="preview-label">Project</label>
                    <div class="w-100">
                        <input type="text" name="project" class="form-control form-input" id="project" placeholder="Project" value="{{ $cart->project }}">
                        @error('project')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group d-flex justify-content-between align-items-center">
                    <label for="title" class="preview-label">Title</label>
                    <div class="w-100">
                        <input type="text" name="title" class="form-control form-input not-allowed" id="title" placeholder="Title" readonly value="{{ $music->title }} | {{ $music->artist }}">
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group d-flex justify-content-between align-items-center">
                    <label for="license" class="preview-label">License</label>
                    <div class="w-100">
                        <select name="license" class="form-control form-input select-tag" id="license" onchange="handleChange(this)">
                            @foreach($totalLicenses as $license)
                            <option value="{{ $license->name }}" {{ $cart->license == $license->name ? 'selected' : '' }}>{{ $license->name }}</option>
                            @endforeach
                        </select>
                        @error('license')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group d-flex justify-content-between align-items-center">
                    <label for="territory" class="preview-label">Territory</label>
                    <div class="w-100">
                        <select name="territory" class="form-control form-input select-tag" id="territory" onchange="handleChange(this)">
                            @foreach($totalTerritories as $territory)
                            <option value="{{ $territory->territory }}" {{ $cart->territory == $territory->territory ? 'selected' : '' }}>{{ $territory->territory }}</option>
                            @endforeach
                        </select>
                        @error('territory')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group d-flex justify-content-between align-items-center">
                    <label for="term" class="preview-label">Term</label>
                    <div class="w-100">
                        <select name="term" class="form-control form-input select-tag" id="term" onchange="handleChange(this)">
                            @foreach($totalTerms as $term)
                            <option value="{{ $term->term }}" {{ $cart->term == $term->term ? 'selected' : '' }}>{{ $term->term }}</option>
                            @endforeach
                        </select>
                        @error('term')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group d-flex justify-content-between align-items-center">
                    <label for="price" class="preview-label">Price</label>
                    <input type="text" name="price" class="form-control form-input not-allowed" id="price" placeholder="Price" readonly value="${{ $cart->price }} USD">
                </div>
                <div class="form-group d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn" id="apply" style="background:#CC0066;color:white;border-radius:20px;padding:4px 20px 7px 20px; margin-top:2px;">Save</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    function handleChange(e) {
        var license = document.getElementById('license').value;
        var territory = document.getElementById('territory').value;
        var term = document.getElementById('term').value;

        // ajax call
        fetch("{{ route('frontend.handle.change') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    license: license,
                    territory: territory,
                    term: term
                })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('territory').innerHTML = data.totalTerritoriesHtml;
                document.getElementById('term').innerHTML = data.totalTermsHtml;
                document.getElementById('price').value = data.totalPriceHtml;
            })
            .catch(error => {
                console.log(error);
            });

    }
</script>
@endsection