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
  #myTable td,
  #myTable th {
    border: 1px solid #dee2e6;
  }

  /* Example: Add padding to the table cells */
  #myTable td,
  #myTable th {
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
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="fw-bold py-3 mb-2">{{$pageTitle}}</h4>
      <a href="{{ route('coupon.create') }}" class="btn btn-primary">Add Coupon</a>
    </div>
    @if (Session::has('success'))
    <div class="alert alert-dark">
      {{ Session::get('success') }}
    </div>
    @endif
    <table class="table table-striped table-bordered" id="myTable">
      <thead>
        <tr class="text-nowrap">
          <th>Code</th>
          <th>Usage Allowed</th>
          <th>Usage Limit</th>
          <th>Discount (In %)</th>
          <th>Valid From</th>
          <th>Valid To</th>
          <th>Created Date</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @if(count($coupons) > 0)
        @foreach($coupons as $key => $coupon)
        <tr>
          <td>{{ $coupon->code }}</td>
          <td>{{ $coupon->usage_allowed }}</td>
          <td>
            {{ $coupon->usage_limit ? $coupon->usage_limit . ' times' : 'Unlimited' }}
          </td>
          <td>{{ $coupon->discount_percentage }}</td>
          <td>
            {{ date('m/d/Y', strtotime($coupon->valid_from)) }}
          </td>
          <td>
            {{ date('m/d/Y', strtotime($coupon->valid_to)) }}
          </td>
          <td>
            {{ date('m/d/Y', strtotime($coupon->date)) }}
          </td>
          <td>{{ $coupon->status == 'active' ? 'Active' : 'Inactive' }}</td>
          <td> <a href="{{ route('coupon.edit', $coupon->id) }}" class="btn btn-primary btn-sm">Edit</a>
            <a href="{{ route('coupon.delete',$coupon->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this coupon?');">Delete</a>
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
        columnDefs: [{
          targets: -1,
          orderable: false
        }]
      });
    });
  </script>
  @endsection