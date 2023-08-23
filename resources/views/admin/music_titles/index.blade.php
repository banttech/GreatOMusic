@extends('layouts.admin.app')

@section('content')
 
  <style>
    /* Example: Add a background color to the table header */
    #myTable thead {
      background-color: #4b4ddb;
    }

    #myTable thead th {
      color: #fff;
    }

    /* Example: Add a border to the table cells */
    #myTable td, #myTable th {
      border: 1px solid #dee2e6;
    }

    /* Example: Add padding to the table cells */
    #myTable td, #myTable th {
      padding: 8px;
    }

    #myTable tbody tr:nth-child(even) {
      background-color: #efeeee;
    }

    /* Search bar styling */
    .dataTables_filter {
      margin-bottom: 10px;
    }

    .dataTables_filter label {
      font-weight: bold;
    }

    .dataTables_filter input[type="search"] {
      padding: 4px 8px;
      border-radius: 4px;
      border: 1px solid #ced4da;
    }

    /* Result text styling */
    .dataTables_info {
      margin-top: 10px;
      font-size: 14px;
      color: #6c757d;
    }
  </style>

<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">     
      
      <!-- <form action="{{ route('musictitles.search') }}" method="GET">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Search by music title" name="search" value="{{ request()->search }}">
          <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
        </div>
      </form> -->

      <div class="d-flex justify-content-between align-items-center mb-3">
          <h4 class="fw-bold py-3 mb-2">{{$pageTitle}}</h4>
          <a href="{{ route('musictitles.create') }}" class="btn btn-primary">Add Music Title</a>
      </div>
      @if (Session::has('success'))
        <div class="alert alert-dark">
            {{ Session::get('success') }}
        </div>
      @endif
      <table class="table table-striped table-bordered" id="myTable">
        <thead>
          <tr class="text-nowrap">
            <th>Title</th>
            <th>Artist</th>
            <th>Genre</th>
            <th>Tempo</th>
            <th>Version</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          
          @if(count($music_titles) > 0)
            @foreach($music_titles as $key => $music_title)
              <tr>
                <td>{{ $music_title->title }}</td>
                <td>{{ $music_title->artist }}</td>
                <?php 
                  $genres = $music_title->genre;
                  $genre_names = explode(',', $genres);
                  $first_genre_name = $genre_names[0];
                ?>
                <td>{{ $first_genre_name }}</td>
                <td>{{ $music_title->tempo }}</td>
                <td>{{ $music_title->version }}</td>
                <td>{{ date('m/d/Y', strtotime($music_title->date)) }}</td>
                <td class="d-flex gap-1">
                    <a href="{{ route('musictitles.edit', $music_title->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <a href="{{ route('musictitles.delete',$music_title->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this music title?');">Delete</a>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td colspan="9" class="text-center text-danger">No Record Found</td>
            </tr>
          @endif
        </tbody>
      </table>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('#myTable').DataTable({
      columnDefs: [
        { targets: -1, orderable: false }
      ]
    });
  });
</script>
@endsection
   
