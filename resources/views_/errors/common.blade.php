@extends('layouts.frontend.app')

@section('content')
    <div class="alert alert-danger">
        <h2>Error: {{ $exception->getStatusCode() }}</h2>
        <p>{{ $exception->getMessage() }}</p>
        <!-- Additional error handling and information here -->
    </div>
@endsection
