@extends('layouts.admin.app')

@section('content')
   
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-lg-12 mb-4 order-0">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-sm-7">
            <div class="card-body">
              <h1 class="card-title text-primary">Welcome To The Admin Area!</h5>
              <p>
                The Admin area is the administration center of the website. This Admin area provides an easy way to edit and adjust all text, images and media.
              </p>
              <p>
                On the left side is the main navigation toolbar which provides access to all administrative functions. This left side navigation provides access to each major section. Some of these management tools also come with a sub-menu that can expand to show extra options.
              </p>
              <p>
                You can return to this main Dashboard landing page in the Admin Area by clicking Admin in the top left navigation menu or by clicking the home icon.
              </p>
            </div>
          </div>
          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img
                src="{{ asset('admin-assets/img/illustrations/man-with-laptop-light.png')}}"
                height="250"
                alt="View Badge User"
                data-app-dark-img="{{ asset('admin-assets/illustrations/man-with-laptop-dark.png')}}"
                data-app-light-img="{{ asset('admin-assets/illustrations/man-with-laptop-light.png')}}"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection