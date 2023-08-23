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

            <h4 class="fw-bold py-3 mb-2">Financial reports for licenses users have purchased</h4>
            <div>
                <a href="{{ route('license.exportCsv') }}" class="btn btn-primary btn-sm">Download CSV</a>
                <a href="{{ route('license.exportExcel') }}" class="btn btn-primary btn-sm">Download Excel</a>
            </div>

        </div>

        @if (Session::has('success'))

        <div class="alert alert-dark">

            {{ Session::get('success') }}

        </div>

        @endif



        <table class="table table-striped table-bordered" id="myTable">

            <thead>

                <tr class="text-nowrap">



                    <th>License Name</th>

                    <th>Title</th>

                    <th>User</th>

                    <th>Territory</th>

                    <th>Term</th>

                    <th>Price</th>

                    <th>Date</th>

                </tr>

            </thead>

            <tbody>



                @if(count($licenses) > 0)

                @foreach($licenses as $key => $license)

                <tr>

                    <td>{{ $license->license }}</td>

                    <?php $music = App\Models\MusicTitle::where('id', $license->track_id)->first(); ?>

                    <td>{{ $music->title }} | {{ $music->artist }}</td>

                    <?php $user = App\Models\User::where('id', $license->user)->first(); ?>

                    <td>{{ $user->email ?? '' }}</td>

                    <td>{{ $license->territory }}</td>

                    <td>{{ $license->term }}</td>

                    <td>${{number_format($license->price, 2)}}</td>

                    <td>{{ date('m-d-Y', strtotime($license->date)) }}</td>

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
                        "targets": [6],
                        "render": function(data, type, row) {
                            if (type === "sort") {
                                return moment(data, "MM-DD-YYYY").format("YYYY-MM-DD");
                            }
                            return data;
                        }
                    }
                ],
                "order": [[6, "desc"]]
            });
        });
    </script>

    @endsection