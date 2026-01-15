@extends('layouts.non-panel.app')

@section('title', 'Book Session - Rose Massage Services')

@section('content')
    
    <div class="container mt-2">
        <h4>Book Session</h4>

        <div class="col-md-5 mx-auto">
            <div class="card">
                
                <div class="card-body p-4">

                    <form action="{{ route('client.bookings.store') }}" method="POST">
                        @csrf

                        @if ($errors->any())
                        <div class="alert alert-danger d-flex align-items-center gap-2 mb-4">
                            <i class="bi bi-x-circle"></i>
                            {{ $errors->first() }}                     
                        </div>
                    
                        @elseif(session('booking_create_success'))
                            <div class="alert alert-success d-flex align-items-center gap-2 mb-4">
                                <i class="bi bi-check-circle-fill"></i>
                                {{ session('booking_create_success') }}
                            </div>
                        @endif

                        <div class="mb-4">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control" name="booking_date">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Service</label>
                            <select class="form-control" name="service_id">
                                <option value="" selected>--Select a service--</option>
                                @forelse ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }} ({{ '$' . $service->price . ' / ' . number_format($service->duration_minutes) }} mins)</option>
                                @empty
                                   <option value="" selected disabled>No services found.</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Therapist</label>
                            <select class="form-control" name="therapist_id">
                                <option value="" selected>--Select a therapist--</option>
                                @forelse ($therapists as $therapist)
                                    <option value="{{ $therapist->id }}">{{ $therapist->name }}</option>
                                @empty
                                   <option value="" selected disabled>No therapists found.</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Time</label>
                            <input type="time" class="form-control" name="booking_start_time">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Book</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection