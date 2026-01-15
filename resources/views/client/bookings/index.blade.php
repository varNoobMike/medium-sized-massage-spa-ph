@extends('layouts.non-panel.app')

@section('title', 'Bookings - Rose Massage Services')

@section('content')
    
    <div class="container mt-2">
    	<h3>Your Bookings</h3>

    	<a href="{{ route('client.bookings.create') }}" class="btn btn-primary mt-4 px-3">
            Book Session
        </a>
    </div>

@endsection