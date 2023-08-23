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

    #myTable td.date-column {
        width: 1%;
        white-space: nowrap;
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
      <h4 class="fw-bold py-3 mb-2">{{$pageTitle}}</h4>
     
      
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
          <th>Reason</th>
          <th>Comments</th>
          <th>Date</th>
          <th>Dalete</th>
          </tr>
      </thead>
      <tbody>
        @if(count($contacts) > 0)
          @foreach($contacts as $key => $contact)
            <tr>
              <td>{{ $contact->name }}</td>
              <td>{{ $contact->email }}</td>
              <td>{{ $contact->reason }}</td>
              <td>{{ $contact->comments }}</td>
              <td class="date-column">{{ date('m-d-Y', strtotime($contact->date)) }}</td>
              <td> 
                  <a href="{{ route('contact.delete',$contact->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this contact?');">Delete</a>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

  <script>
    $(document).ready(function() {
            $('#myTable').DataTable({
                "columnDefs": [
                    {
                        "type": "date",
                        "targets": [4],
                        "render": function(data, type, row) {
                            if (type === "sort") {
                                return moment(data, "MM-DD-YYYY").format("YYYY-MM-DD");
                            }
                            return data;
                        }
                    },
                    {
                        "targets": -1,
                        "orderable": false
                    }
                ],
                "order": [[4, "desc"]],
            });
        });
  </script>
@endsection
   
