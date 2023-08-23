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
              <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Home</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('home.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row mb-3">
                    <label class="col-sm-2 form-label footertxt" for="basic-icon-default-message">Footer Text<span class="text-danger" style="font-size: 16px;">*</span></label>
                    <div class="col-sm-10">
                      <div class="input-group input-group-merge">
                        <span id="basic-icon-default-message2" class="input-group-text"style="border:none!important;"
                          ></span>
                        <textarea
                          id="basic-icon-default-message"
                          name="text"
                          class="form-control"
                          placeholder=""
                          rows="10" cols=""
                    >{{$pageshome->text}}</textarea>
                      </div>
                    </div>
                    @error('text')
                    <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
                     @enderror
                  </div>

                  <hr size="4px" width="100%">
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Music Title Featured<span class="text-danger" style="font-size: 16px;">*</span></label>
                    <div class="col-sm-10">
                      <select id="largeSelect" class="form-select form-select-lg" name="musictitle_id">
                        @foreach($pagesmusictitles as $key => $pagesmusictitle)
                        <option value="{{$pagesmusictitle->id}}" @if($pagesmusictitle->id == $pageshome->music_player_title_id) selected @endif>{{$pagesmusictitle->title}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <hr size="4px" width="100%">
                  <div class="card-header d-flex align-items-center justify-content-between" style="padding-left: 8px;">
                    <h5 class="mb-0">Newsletter Section</h5>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label " for="basic-default-name">Newsletter Heading<span class="text-danger" style="font-size: 16px;">*</span></label>
                    <div class="col-sm-10">
                      <input
                        type="text"
                        id="basic-default-name"
                        class="form-control"
                        name="news_heading"
                        placeholder=""
                        value="{{$pageshome->news_heading}}"
                      />
                      @error('news_heading')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="row mb-4">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Newsletter Sub-Heading<span class="text-danger" style="font-size: 16px;">*</span></label>
                    <div class="col-sm-10">
                      <input
                        type="text"
                        id="basic-default-name"
                        class="form-control"
                        name="news_sub_heading"
                        placeholder=""
                        value="{{$pageshome->news_sub_heading}}"
                      />
                      @error('news_sub_heading')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="row mb-4">
                    <label class="col-sm-2 col-form-label " for="basic-default-name">Newsletter Image<br>(1800 x 476 pixel)<span class="text-danger" style="font-size: 16px;">*</span></label>
                    <div class="col-sm-10">
                      <img class="mt-2 mb-3" src="{{ url('admin-assets/images/'.$pageshome->news_image)}}" alt=" "
                      width="100%" height="200px" id="news_letter_image" />
                      <input
                        type="file"
                        id="basic-default-name"
                        class="form-control"
                        name="news_image"
                        placeholder=""
                        value="{{$pageshome->news_image}}"
                      />
                      @error('news_image')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>           
                  <div class="row justify-content-">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
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
        CKEDITOR.replace('text');
        CKEDITOR.config.width = 1250  
        CKEDITOR.config.height = 300

        const newsLetterImg = document.getElementById('news_letter_image');
        const newsLetterInput = document.querySelector('input[name="news_image"]');
        newsLetterInput.addEventListener('change', function() {
          console.log('hello');
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.addEventListener('load', function() {
                    newsLetterImg.setAttribute('src', this.result);
                });
                reader.readAsDataURL(file);
            }
        });

      
    </script>
  @endsection