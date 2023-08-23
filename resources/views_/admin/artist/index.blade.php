@extends('layouts.admin.app')

@section('content')
 

<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-2">{{$pageTitle}}</h4>
     
      
      <form action="{{ route('artist.search') }}" method="GET">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Search by Artist Name" name="search" value="{{ request()->search }}">
          <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
        </div>
      </form>

      <div class="d-flex justify-content-end mb-2">
          <a href="{{ route('artist.create') }}" class="btn btn-primary">Add Artist</a>
          
      </div>

      <div class="card">
        <div class="table-responsive text-nowrap mt-3">
          <table class="table">
            <thead>
              <tr class="text-nowrap">
            
            <th>Name</th>
            <th>Actions</th>
            </tr>
            </thead>
            <tbody>
              @if (Session::has('success'))
              <div class="alert alert-dark">
                  {{ Session::get('success') }}
              </div>
          @endif
              @if(count($artists) > 0)
                @foreach($artists as $key => $artist)
                  <tr>
                   
                    <td>{{ $artist->name }}</td>
                    <td> <a href="{{ route('artist.edit', $artist->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <a href="{{ route('artist.delete',$artist->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this name!');">Delete</a>
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
  <div class="d-flex justify-content-center mt-3">
    {{ $artists->links() }}
  </div>
</div>
@endsection
   
