@extends('layouts.non-panel.app')

@section('title', 'Search Available Bookings - Rose Massage Services')

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

                    <form action="{{ route('client.bookings.availabilities.index') }}" method="GET">

                        <div class="mb-4">
                            <label class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('booking_date') is-invalid @enderror" 
                                name="booking_date" value="{{ request('booking_date') }}">

                            @error('booking_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-4">
                            <label class="form-label">Service <span class="text-danger">*</span></label>
                            <select 
                                class="form-control @error('service_id') is-invalid @enderror" 
                                name="service_id"
                            >
                                <option value="">--Select a service--</option>
                                @forelse ($services as $service)
                                    <option value="{{ $service->id }}" 
                                        @selected(request('service_id') == $service->id) >
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
                            <label class="form-label">Therapist <span class="text-danger">*</span></label>
                            <select 
                                class="form-control @error('therapist_id') is-invalid @enderror" 
                                name="therapist_id"
                            >
                                <option value="">--Select a therapist--</option>
                                @forelse ($therapists as $therapist)
                                    <option value="{{ $therapist->id }}" 
                                        @selected(request('therapist_id') == $therapist->id) >
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

                        <button type="submit" name="search" value="1" class="btn btn-primary w-100 d-flex gap-2 justify-content-center align-items-center">
                            <i class="bi bi-search"></i>
                            <span>Search Available</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>


        @if(isset($slots))
        <div id="results" class="mt-5">
            <!-- here -->
            <h4 class="text-center pt-5 mb-4">Available Slots</h4>
            @forelse($slots as $index => $slot)
                <div class="card col-md-5 mx-auto mb-4">
                    <div class="card-body d-flex justify-content-between">
                        <div>
                            {{ $slot->start_time }} <span class="mx-2">---</span>
                            {{ $slot->end_time }}
                        </div>
                        <div>

                            <a href="{{ route('client.bookings.create', ['slot_index' => $index])}}"
                            class="btn btn-outline-primary btn-sm">
                                Book
                            </a>

                        </div>
                        
                    </div>
                </div>
            @empty
            <h3>No available slots.</h3>
            @endforelse
        </div>
        @endif

    </div>

@endsection