@extends('layouts.non-panel.app')

@section('title', 'Bookings - Rose Massage Services')

@section('content')
    
    <div class="container mt-2">
    	<h3>Your Bookings</h3>


        {{-- Alerts --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-3 small d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-exclamation-circle-fill opacity-75"></i>
                <div>{{ $errors->first() }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session('booking_action_success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-3 small d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-check-circle-fill opacity-75"></i>
                <div>{{ session('booking_action_success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    	<a href="{{ route('client.bookings.availabilities.index') }}" class="btn btn-primary mt-4 px-3">
            Book Session
        </a>
    </div>

@endsection