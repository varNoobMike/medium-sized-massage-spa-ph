@extends('layouts.non-panel.app')

@section('title', 'Booking - Rose Massage Services')

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
                            <label class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="hidden" name="booking_date" value="{{ $selected->get('booking_date') }}">
                            <input type="date" @disabled(true) class="form-control @error('booking_date') is-invalid @enderror" value="{{ $selected->get('booking_date') }}">

                            @error('booking_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-4">
                            <label class="form-label">Service <span class="text-danger">*</span></label>
                            <input type="hidden" name="service_id" value="{{ $selected->get('service_id') }}">
                            <select @disabled(true)
                                    class="form-control @error('service_id') is-invalid @enderror">
                                <option value="">--Select a service--</option>
                                @forelse ($services as $service)
                                    <option value="{{ $service->id }}" 
                                        @selected($selected->get('service_id') == $service->id) >
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
                            <label class="form-label">Start Time <span class="text-danger">*</span></label>
                            <input type="hidden" name="start_time" value="{{ $selected->get('start_time') }}">
                            <input type="time" @disabled(true) class="form-control @error('start_time') is-invalid @enderror" 
                                value="{{ $selected->get('start_time') }}">

                            @error('start_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror 
                        </div>

                        <div class="mb-4">
                            <label class="form-label">End Time <span class="text-danger">*</span></label>
                            <input type="hidden" name="end_time" value="{{ $selected->get('end_time') }}">
                            <input type="time" @disabled(true) class="form-control @error('end_time') is-invalid @enderror"     value="{{ $selected->get('end_time') }}">

                            @error('end_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Therapist <span class="text-danger">*</span></label>
                             <input type="hidden" name="therapist_id" value="{{ $selected->get('therapist_id') }}">
                            <select 
                                @disabled(true)
                                class="form-control @error('therapist_id') is-invalid @enderror">
                                <option value="">--Select a therapist--</option>
                                @forelse ($therapists as $therapist)
                                    <option value="{{ $therapist->id }}" 
                                        @selected($selected->get('therapist_id') == $therapist->id) >
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

                        <button type="submit" class="btn btn-primary w-100 d-flex gap-2 justify-content-center align-items-center">
                            <span>Book</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection