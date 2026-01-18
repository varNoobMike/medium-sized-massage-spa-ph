@extends('layouts.panel.app')

@section('title', 'Manage Spa Settings')
@section('page-heading', 'Spa Settings')
@section('page-heading-small', 'Manage spa profile details here.')

@section('content')

{{-- Alerts --}}
@if($errors->any())
    <div class="alert alert-danger rounded-3 mb-3 small d-flex align-items-center gap-2" role="alert">
        <i class="bi bi-exclamation-circle-fill"></i>
        {{ $errors->first() }}
    </div>
@elseif(session('spa_profile_update_success'))
    <div class="alert alert-success rounded-3 mb-3 small d-flex align-items-center gap-2" role="status">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('spa_profile_update_success') }}
    </div>
@endif

{{-- Desktop / Large Screens --}}
<div class="d-none d-lg-block">
    <div class="row g-3 mb-4">

        {{-- Name & Logo --}}
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-3 hover-shadow p-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    @if($setting->logo)
                        <img src="{{ asset('storage/' . $setting->logo) }}" alt="Spa logo" class="rounded" width="52" height="52">
                    @else
                        <span class="badge bg-secondary-subtle text-muted small">No Logo</span>
                    @endif
                    <div>
                        <div class="fw-semibold fs-5 text-dark">{{ $setting->name }}</div>
                        <div class="small text-muted">Manage spa profile and booking settings</div>
                    </div>
                </div>
                <div class="mt-2">
                    <button class="btn btn-sm btn-primary rounded-3" data-bs-toggle="modal" data-bs-target="#upload-logo-modal">
                        <i class="bi bi-upload"></i> Upload Logo
                    </button>
                </div>
            </div>
        </div>

        {{-- Information Settings --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-3 hover-shadow p-3 d-flex align-items-start gap-2">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-info-circle fs-5"></i>
                    <div class="fw-semibold text-dark">Information</div>
                    <button class="btn btn-sm btn-light ms-auto" data-bs-toggle="modal" data-bs-target="#edit-info-modal">
                        <i class="bi bi-pencil"></i> Edit
                    </button>
                </div>
                <div class="small text-muted">Email: <span class="text-dark">{{ $setting->spaSetting->email ?? '—' }}</span></div>
                <div class="small text-muted">Contact #: <span class="text-dark">{{ $setting->spaSetting->contact_number ?? '—' }}</span></div>
                <div class="small text-muted">Location: <span class="text-dark">{{ $setting->spaSetting->location ?? '—' }}</span></div>
            </div>
        </div>

        {{-- Booking Settings --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-3 hover-shadow p-3 d-flex align-items-start gap-2">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-calendar-check fs-5"></i>
                    <div class="fw-semibold text-dark">Booking</div>
                    <button class="btn btn-sm btn-light ms-auto" data-bs-toggle="modal" data-bs-target="#edit-booking-modal">
                        <i class="bi bi-pencil"></i> Edit
                    </button>
                </div>
                <div class="small text-muted">Total Beds: <span class="text-dark">{{ $setting->spaSetting->total_beds ?? '—' }}</span></div>
                <div class="small text-muted">Buffer Start: <span class="text-dark">{{ $setting->spaSetting->booking_buffer_start ?? 0 }} mins</span></div>
                <div class="small text-muted">Buffer End: <span class="text-dark">{{ $setting->spaSetting->booking_buffer_end ?? 0 }} mins</span></div>
            </div>
        </div>

    </div>
</div>

{{-- Mobile / Small Screens --}}
<div class="d-lg-none">
    <div class="mb-3">

        {{-- Name & Logo --}}
        <div class="card border rounded-3 mb-3 shadow-sm hover-shadow p-3 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                @if($setting->logo)
                    <img src="{{ asset('storage/' . $setting->logo) }}" alt="Spa logo" class="rounded" width="52" height="52">
                @else
                    <span class="badge bg-secondary-subtle text-muted small">No Logo</span>
                @endif
                <div>
                    <div class="fw-semibold text-dark">{{ $setting->name }}</div>
                    <div class="small text-muted">Manage spa profile and booking settings</div>
                </div>
            </div>
            <div class="mt-2">
                <button class="btn btn-sm btn-primary rounded-3" data-bs-toggle="modal" data-bs-target="#upload-logo-modal">
                    <i class="bi bi-upload"></i> Upload Logo
                </button>
            </div>
        </div>

        {{-- Information Settings --}}
        <div class="card border rounded-3 mb-3 shadow-sm hover-shadow p-3">
            <div class="d-flex align-items-center gap-2 mb-2">
                <i class="bi bi-info-circle fs-5"></i>
                <div class="fw-semibold text-dark">Information</div>
                <button class="btn btn-sm btn-light ms-auto" data-bs-toggle="modal" data-bs-target="#edit-info-modal">
                    <i class="bi bi-pencil"></i> Edit
                </button>
            </div>
            <div class="small text-muted">Email: <span class="text-dark">{{ $setting->spaSetting->email ?? '—' }}</span></div>
            <div class="small text-muted">Phone: <span class="text-dark">{{ $setting->spaSetting->contact_number ?? '—' }}</span></div>
            <div class="small text-muted">Location: <span class="text-dark">{{ $setting->spaSetting->location ?? '—' }}</span></div>
        </div>

        {{-- Booking Settings --}}
        <div class="card border rounded-3 mb-3 shadow-sm hover-shadow p-3">
            <div class="d-flex align-items-center gap-2 mb-2">
                <i class="bi bi-calendar-check fs-5"></i>
                <div class="fw-semibold text-dark">Booking</div>
                <button class="btn btn-sm btn-light ms-auto" data-bs-toggle="modal" data-bs-target="#edit-booking-modal">
                    <i class="bi bi-pencil"></i> Edit
                </button>
            </div>
            <div class="small text-muted">Total Beds: <span class="text-dark">{{ $setting->spaSetting->total_beds ?? '—' }}</span></div>
            <div class="small text-muted">Buffer Start: <span class="text-dark">{{ $setting->spaSetting->booking_buffer_start ?? 0 }} mins</span></div>
            <div class="small text-muted">Buffer End: <span class="text-dark">{{ $setting->spaSetting->booking_buffer_end ?? 0 }} mins</span></div>
        </div>

    </div>
</div>
@endsection
