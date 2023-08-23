@extends('layouts.admin.app')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Layout & Basic with Icons -->
    @include('layouts.partials.messages')
    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-body">
            <form action="{{ route('send-promotion-email') }}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Email Sent To<span class="text-danger" style="font-size: 16px;">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="sent_to" class="form-control" id="basic-default-name"
                        placeholder="" required value="{{ old('sent_to') }}" />
                        @error('sent_to')
                            <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Email Body<span class="text-danger" style="font-size: 16px;">*</span></label>
                    <div class="col-sm-10">
                        <textarea
                            id="basic-icon-default-message"
                            name="email_body"
                            class="form-control"
                            placeholder=""
                            rows="10" cols=""
                        >{{ old('email_body') }}</textarea>
                        @error('email_body')
                            <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Email From</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="email_from" value="{{ env('MAIL_FROM_ADDRESS') }}" />
                        <input type="text" name="" class="form-control" id="basic-default-name"
                        placeholder="" value="{{ env('MAIL_FROM_ADDRESS') }}" disabled />
                        @error('email_from')
                            <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row justify-content-">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Send Mail</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('email_body');
  </script>

  @endsection