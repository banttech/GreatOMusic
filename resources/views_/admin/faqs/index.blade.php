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
      
      <!-- <form action="{{ route('faqs.search') }}" method="GET">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Search by question" name="search" value="{{ request()->search }}">
          <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
        </div>
      </form> -->

      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold py-3 mb-2">{{$pageTitle}}</h4>
          <a href="{{ route('faqs.create') }}" class="btn btn-primary" style="height: 40px;">Add FAQ</a>
      </div>

      <table class="table table-striped table-bordered" id="myTable">
        <thead>
          <tr class="text-nowrap">
            <th>Question</th>
            <th>Answer</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @if(count($faqs) > 0)
            @foreach($faqs as $key => $faq)
              <tr>
                <td>
                  <a href="{{ route('faqs.details', $faq->id) }}">
                    {{ Str::limit($faq->question, 30, '...') }}
                  </a>
                </td>
                <td>
                  <a href="{{ route('faqs.details', $faq->id) }}">
                    {!! Str::limit($faq->answer, 100, '...') !!}
                  </a>
                </td>
                <td> 
                    <a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <a href="{{ route('faqs.delete',$faq->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this faq?');">Delete</a>
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
      ],
      "order": []
    });
  });
</script>
@endsection
   
