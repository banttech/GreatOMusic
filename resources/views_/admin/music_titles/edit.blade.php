@extends('layouts.admin.app')

@section('content')

    <style>
        .music_text {
            margin: 0px;
            padding: 7px;
            background: #CCCCCC;
            border-radius: 2px;
            color: #000 !important;
        }
    </style>

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
                <h5 class="mb-0">Edit Music Title</h5>
               
              </div>
              <div class="card-body">
                <form action="{{ route('musictitles.update',$music_titles->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row mb-3">
                    <label class="col-sm-1 col-form-label" for="basic-default-name">Title<span class="text-danger" style="font-size: 16px;">*</span></label>
                    <div class="col-sm-11">
                      <input type="text" name="title" class="form-control" id="basic-default-name" placeholder="Enter title" value="{{ $music_titles->title }}" required />
                    </div>
                    @error('title')
                    <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
                     @enderror
                  </div>

                 
                  <div class="row mb-3">
                    <label class="col-sm-1 col-form-label" for="basic-default-name">Artist<span class="text-danger" style="font-size: 16px;">*</span></label>
                    <div class="col-sm-11">
                      <select id="largeSelect" class="form-select form-select-lg" name="artist">
                        @foreach($artists as $key => $artist)
                        <option value="{{$artist->name}}" {{ $music_titles->artist == $artist->name ? 'selected' : ''}}>
                          {{$artist->name}}
                        </option>
                        @endforeach
                      </select>
                    </div>
                    
                  </div>
                 

                  <?php 
                    $totalGenres = $music_titles->genre;
                    $genre_names = explode(', ', $totalGenres);
                    $first_genre_name = '';
                    $second_genre_name = '';
                    $third_genre_name = '';
                    if(count($genre_names) == 1) {
                      $first_genre_name = $genre_names[0];
                    }
                    if(count($genre_names) == 2) {
                      $first_genre_name = $genre_names[0];
                      $second_genre_name = $genre_names[1];
                    }
                    if(count($genre_names) == 3) {
                      $first_genre_name = $genre_names[0];
                      $second_genre_name = $genre_names[1];
                      $third_genre_name = $genre_names[2];
                    } 
                    // echo $first_genre_name;
                    // echo '<br>';
                    // echo $second_genre_name;
                    // echo '<br>';
                    // echo $third_genre_name;
                  ?>
                  <div class="row mb-3">
                    <label class="col-sm-1 col-form-label" for="basic-default-name">Genre<span class="text-danger" style="font-size: 16px;">*</span></label>
                    <div class="col-sm-4">
                      <select id="largeSelect" class="form-select form-select-lg" name="first_genre_name">
                        @foreach($genres as $key => $genre)
                        <option value="{{$genre->name}}" {{ $first_genre_name == $genre->name ? 'selected' : ''}}>
                          {{$genre->name}}
                        </option>
                        @endforeach
                       
                      </select>
                    </div>
                   
                    <div class="col-sm-4">
                      <select id="largeSelect" class="form-select form-select-lg" name="second_genre_name">
                        <option value="">Second Genre</option>
                        @foreach($genres as $key => $genre)
                        <option value="{{$genre->name}}" {{ $second_genre_name == $genre->name ? 'selected' : ''}}>
                          {{$genre->name}}
                        </option>
                        @endforeach
                      </select>
                    </div>
                
                    <div class="col-sm-3">
                      <select id="largeSelect" class="form-select form-select-lg" name="third_genre_name">
                        <option value="0">Third Genre</option>
                        @foreach($genres as $key => $genre)
                        <option value="{{$genre->name}}" {{ $third_genre_name == $genre->name ? 'selected' : ''}}>
                          {{$genre->name}}
                        </option>
                        @endforeach
                       
                      </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-1 col-form-label" for="basic-default-name">Tempo<span class="text-danger" style="font-size: 16px;">*</span></label>
                    <div class="col-sm-4">
                      <select id="largeSelect" class="form-select form-select-lg" name="tempo">
                        @foreach($tempos as $key => $tempo)
                        <option value="{{$tempo->name}}" {{ $music_titles->tempo == $tempo->id ? 'selected' : ''}}>
                          {{$tempo->name}}
                        </option>
                        @endforeach
                      </select>
                    </div>
                    
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-1 col-form-label" for="basic-default-name">Version<span class="text-danger" style="font-size: 16px;">*</span></label>
                    <div class="col-sm-4">
                      <select id="largeSelect" class="form-select form-select-lg" name="version">
                        @foreach($versions as $key => $version)
                        <option value="{{$version->name}}" {{ $music_titles->version == $version->name ? 'selected' : ''}}>
                          {{$version->name}}
                        </option>
                        @endforeach
                      </select>
                    </div>
                    
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-1 col-form-label" for="basic-default-name">mp3 format<span class="text-danger" style="font-size: 16px;">*</span></label>
                    <div class="col-sm-4">
                        <input
                        type="file"
                        name="file"
                        class="form-control"
                        />
                        <p class="text-danger">(Only .mp3 files are allowed.)</p>
                    </div>
                    <div class="col-sm-4">
                        @if($music_titles->file)
                            <p class="music_text">
                                {{ $music_titles->file }}
                            </p>
                        @endif
                    </div>
                    @error('file')
                    <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-1 col-form-label" for="basic-default-name">wav format<span class="text-danger" style="font-size: 16px;">*</span></label>
                    <div class="col-sm-4">
                        <input
                        type="file"
                        name="file1"
                        class="form-control"
                        />
                        <p class="text-danger">(Only .wav files are allowed.)</p>
                    </div>
                    <div class="col-sm-4">
                        @if($music_titles->file1)
                            <p class="music_text">
                                {{ $music_titles->file1 }}
                            </p>
                        @endif
                    </div>
                    @error('file1')
                        <div class="alert alert-danger offset-sm-1 col-sm-11">{{ $message }}</div>
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
        CKEDITOR.replace('text');
        CKEDITOR.config.width = 1250  
        CKEDITOR.config.height = 300
    </script>
  @endsection