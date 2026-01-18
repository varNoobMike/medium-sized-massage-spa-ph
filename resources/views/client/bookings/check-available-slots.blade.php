@extends('layouts.non-panel.app')

@section('title', 'Book Session - Rose Massage Services')

@section('content')
    
    <div class="container mt-2">
        <h4>Book Session</h4>

        <div class="col-md-5 mx-auto">
            <div class="card">
                
                <div class="card-body p-4">

                    {{-- Alerts --}}
                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3 mb-4 small d-flex align-items-start gap-2" role="alert">
                            <i class="bi bi-exclamation-circle-fill" aria-hidden="true"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('client.bookings.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control @error('booking_date') is-invalid @enderror" name="booking_date" value="{{ old('booking_date') }}">
                        </div>


                        <div class="mb-4">
                            <label class="form-label">Service</label>
                            <select 
                                class="form-control @error('service_id') is-invalid @enderror" 
                                name="service_id"
                            >
                                <option value="">--Select a service--</option>
                                @forelse ($services as $service)
                                    <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }} ({{ '$' . $service->price . ' / ' . $service->duration_minutes }} mins)
                                    </option>
                                @empty
                                    <option value="" disabled>No services found.</option>
                                @endforelse
                            </select>
                            @error('service_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Therapist</label>
                            <select 
                                class="form-control @error('therapist_id') is-invalid @enderror" 
                                name="therapist_id"
                            >
                                <option value="">--Select a therapist--</option>
                                @forelse ($therapists as $therapist)
                                    <option value="{{ $therapist->id }}" {{ old('therapist_id') == $therapist->id ? 'selected' : '' }}>
                                        {{ $therapist->name }}
                                    </option>
                                @empty
                                    <option value="" disabled>No therapists found.</option>
                                @endforelse
                            </select>
                            @error('therapist_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Search Avaialable Slots</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection