@extends('layouts.admin.app')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Add New Coupon</h5>

          </div>
          <div class="card-body">
            <form action="{{ route('coupon.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Coupon Code<span class="text-danger" style="font-size: 16px;">*</span></label>
                <div class="col-sm-10">
                  <input type="text" name="code" class="form-control" id="basic-default-name" placeholder="Enter coupon name" value="{{ old('code') }}" required />
                  @error('code')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Status<span class="text-danger" style="font-size: 16px;">*</span></label>
                <div class="col-sm-10">
                  <input type="radio" name="status" value="active" @if(old('status')=='active' || !old('status')) checked @endif required> Active
                  <input type="radio" name="status" value="inactive" @if(old('status')=='inactive' ) checked @endif required> Inactive
                  @error('status')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Usage Allowed<span class="text-danger" style="font-size: 16px;">*</span></label>
                <div class="col-sm-10">
                  <input type="radio" name="usage_allowed" value="unlimited" @if(old('usage_allowed')=='unlimited' || !old('usage_allowed')) checked @endif required> Unlimited use
                  <input type="radio" name="usage_allowed" value="limited" @if(old('usage_allowed')=='limited' ) checked @endif required> Limited use
                  @error('usage_allowed')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row mb-3" id="usage_limit" style="display: none;">
                <label class="col-sm-2 col-form-label" for="basic-default-name"></label>
                <div class="col-sm-10">
                  <input type="text" name="usage_limit" class="form-control" placeholder="Usage Limit" value="{{ old('usage_limit') }}" oninput="validateUsageLimit(this)" />
                  <p class="text-danger">Number of times coupon can be used.</p>
                  @error('usage_limit')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Discount (In %)<span class="text-danger" style="font-size: 16px;">*</span></label>
                <div class="col-sm-10">
                  <input type="number" name="discount_percentage" class="form-control" id="basic-default-name" placeholder="Discount (In %)" min="0" value="{{ old('discount_percentage') }}" oninput="validateDiscountPercentage(this)" required />
                  @error('discount_percentage')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Valid From<span class="text-danger" style="font-size: 16px;">*</span></label>
                <div class="col-sm-10">
                  <input type="date" name="valid_from" class="form-control" id="basic-default-name" placeholder="Enter coupon name" value="{{ old('valid_from') }}" required />
                  @error('valid_from')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Valid To<span class="text-danger" style="font-size: 16px;">*</span></label>
                <div class="col-sm-10">
                  <input type="date" name="valid_to" class="form-control" id="basic-default-name" placeholder="Enter coupon name" value="{{ old('valid_to') }}" required />
                  @error('valid_to')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Description<span class="text-danger" style="font-size: 16px;">*</span></label>
                <div class="col-sm-10">
                  <textarea name="description" class="form-control" id="basic-default-name" placeholder="Enter coupon description" required>{{ old('description') }}</textarea>
                  @error('description')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row justify-content-">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script>
    // if user select limited then show usage limit field
    var radioButtons = document.querySelectorAll('input[type=radio][name=usage_allowed]');

    radioButtons.forEach(function(radioButton) {
      radioButton.addEventListener('change', function() {
        if (this.value === 'limited') {
          document.getElementById('usage_limit').style.display = 'flex';
        } else {
          document.getElementById('usage_limit').style.display = 'none';
        }
      });
    });

    // on page load check if limited is selected then show usage limit field
    window.onload = function() {
      var radioButtons = document.querySelectorAll('input[type=radio][name=usage_allowed]');

      radioButtons.forEach(function(radioButton) {
        if (radioButton.checked && radioButton.value === 'limited') {
          document.getElementById('usage_limit').style.display = 'flex';
        }
      });
    };

    function validateUsageLimit(input) {
      var usageLimitValue = input.value;

      if (usageLimitValue <= 0 || isNaN(Number(usageLimitValue))) {
        input.value = '';
      }
    }

    function validateDiscountPercentage(input) {
      var discountPercentageValue = input.value;

      if (discountPercentageValue <= 0 || isNaN(Number(discountPercentageValue))) {
        input.value = '';
      }
    }
  </script>

  @endsection