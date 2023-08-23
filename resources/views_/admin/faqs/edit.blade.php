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
              <div class="card-header">
                <h5 class="mb-0">Edit FAQ</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('faqs.update', $faq->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4">
                        <label class="col-form-label" for="basic-default-name">Question<span class="text-danger" style="font-size: 16px;">*</span></label>
                        <div class="col-sm-12">
                            <input type="text" name="question" class="form-control" id="basic-default-name" value="{{ $faq->question }}" />
                        </div>
                        @error('question')
                            <div class="alert alert-danger col-sm-6 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-4">
                        <label class="col-form-label" for="basic-default-name">Answer<span class="text-danger" style="font-size: 16px;">*</span></label>
                        <div class="col-sm-12">
                            <textarea name="answer" class="form-control" id="basic-default-name" rows="10" cols="50">
                                {{ $faq->answer }}
                            </textarea>
                        </div>
                        @error('answer')
                            <div class="alert alert-danger col-sm-6 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row justify-content-">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Update</button>
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
            CKEDITOR.replace( 'answer' );
        </script>
  @endsection