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
              <div class="card-header">
                <h4 class="fw-bold py-3 mb-2">{{$pageTitle}}</h4>
                <hr size="4px" width="100%">
              </div>
              <div class="card-body">
                <h3>{{ $faq->question }}?</h3>
                <p class="text-justify">{!! $faq->answer !!}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
  @endsection