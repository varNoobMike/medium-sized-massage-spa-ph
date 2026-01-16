@extends('layouts.panel.app')

@section('title', 'Manage Spa Settings')

@section('page-heading', 'Spa Settings')
@section('page-heading-small', 'Manage spa profile details here.')

@section('content')

{{-- Alerts --}}
@if($errors->any())
    <div class="alert alert-danger rounded-3 mb-4 small d-flex align-items-center gap-2">
        <i class="bi bi-exclamation-circle-fill"></i>
        {{ $errors->first() }}
    </div>
@elseif(session('spa_profile_update_success'))
    <div class="alert alert-success rounded-3 mb-4 small d-flex align-items-center gap-2">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('spa_profile_update_success') }}
    </div>
@endif

{{-- Desktop / Large Screens --}}
<div class="d-none d-lg-block">
    <div class="card shadow-sm rounded-3 mb-4">
        <div class="card-body p-3 d-flex justify-content-between align-items-center">
            
            {{-- Info --}}
<div class="d-flex flex-column gap-3">

    {{-- Spa Name --}}
    <div class="fw-semibold text-dark fs-5">
        {{ $setting->name }}
    </div>

    {{-- Info Settings --}}
    <div>
        <div class="text-uppercase fw-semibold text-primary small mb-1">
            Information Settings
        </div>

        <div class="small text-muted">
            Email:
            <span class="text-dark">{{ $setting->spaSetting->email ?? '—' }}</span>
        </div>

        <div class="small text-muted">
            Contact #:
            <span class="text-dark">{{ $setting->spaSetting->contact_number ?? '—' }}</span>
        </div>

        <div class="small text-muted">
            Location:
            <span class="text-dark">{{ $setting->spaSetting->location ?? '—' }}</span>
        </div>
    </div>

    {{-- Booking Settings --}}
    <div>
        <div class="text-uppercase fw-semibold text-primary small mb-1">
            Booking Settings
        </div>

        <div class="small text-muted">
            Total Beds:
            <span class="text-dark">{{ $setting->spaSetting->total_beds ?? '—' }}</span>
        </div>

        <div class="small text-muted">
            Buffer Start:
            <span class="text-dark">
                {{ $setting->spaSetting->booking_buffer_start ?? 0 }} mins
            </span>
        </div>

        <div class="small text-muted">
            Buffer End:
            <span class="text-dark">
                {{ $setting->spaSetting->booking_buffer_end ?? 0 }} mins
            </span>
        </div>
    </div>

</div>


            {{-- Logo & Actions --}}
            <div class="d-flex flex-column align-items-end gap-2">
                @if($setting->logo)
                    <img src="{{ asset('storage/' . $profile->logo) }}" alt="Logo" class="rounded" width="50">
                @else
                    <span class="badge bg-secondary-subtle text-muted small">No Logo</span>
                @endif

                <div class="dropdown">
                    <button class="btn btn-sm btn-light border rounded-3" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end rounded-3 shadow-sm">
                        <li>
                            <a href="#" class="dropdown-item small"><i class="bi bi-eye me-2"></i>View</a>
                        </li>
                        <li>
                            <a href="#" class="dropdown-item small"><i class="bi bi-pencil me-2"></i>Edit</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Mobile / Small Screens --}}
<div class="d-lg-none">
    <div class="card shadow-sm rounded-3 mb-3">
        <div class="card-body p-3">

            <div class="d-flex justify-content-between align-items-start mb-2">
                <div class="fw-semibold text-dark small">{{ $setting->name }}</div>

                <div class="dropdown position-relative">
                    <button class="btn btn-sm btn-light border rounded-3" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end rounded-3 shadow-sm">
                        <li>
                            <a href="#" class="dropdown-item small">
                                <i class="bi bi-eye me-2"></i>View
                            </a>
                        </li>
                        <li>
                            <a href="#" class="dropdown-item small">
                                <i class="bi bi-pencil me-2"></i>Edit
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="small text-muted mb-1">Email</div>
            <div class="small mb-2">{{ $setting->spaSetting->email }}</div>

            <div class="small text-muted mb-1">Phone</div>
            <div class="small mb-2">{{ $setting->spaSetting->contact_number }}</div>

            <div class="small text-muted mb-1">Location</div>
            <div class="small mb-2">{{ $setting->spaSetting->location }}</div>

            <div class="small text-muted mb-1">Total Beds</div>
            <div class="small mb-2">{{ $setting->spaSetting->total_beds }}</div>

            <div class="small text-muted mb-1">Logo</div>
            <div class="small mb-2">
                @if($setting->spaSetting->logo)
                    <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo" class="rounded" width="50">
                @else
                    <span class="badge bg-secondary-subtle text-muted small">No Logo</span>
                @endif
            </div>

        </div>
    </div>
</div>

@endsection
