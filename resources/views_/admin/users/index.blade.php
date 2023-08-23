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
      <h4 class="fw-bold py-3 mb-2">User List</h4>
     
      
      <!-- <form action="{{ route('contact.search') }}" method="GET">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Search by name, email" name="search" value="{{ request()->search }}">
          <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
        </div>
      </form> -->
      @if (Session::has('success'))
          <div class="alert alert-dark">
              {{ Session::get('success') }}
          </div>
      @endif

    <table class="table table-striped table-bordered" id="myTable">
      <thead>
        <tr class="text-nowrap">    
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Company</th>
          <th>Website</th>
          <th>Actions</th>
          </tr>
      </thead>
      <tbody>
        @if(count($users) > 0)
          @foreach($users as $key => $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->company }}</td>
                <td>{{ $user->website }}</td>
                <td class="d-flex gap-1"> 
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <a href="{{ route('user.delete',$user->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this User?');">Delete</a>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable({
        columnDefs: [
          { targets: -1, orderable: false }
        ],
        "order": []
      });
    });
  </script>
@endsection
   
