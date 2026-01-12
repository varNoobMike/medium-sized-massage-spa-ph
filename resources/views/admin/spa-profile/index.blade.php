@extends('layouts.admin.app')

@section('title', 'Manage Spa Profile')

@section('page-heading', 'Manage Spa Profile')
@section('page-heading-small', 'Manage spa profile details here.')

@section('content')

{{-- Alerts --}}
@if($errors->any())
    <div class="alert alert-danger rounded-3 mb-4 small">
        {{ $errors->first() }}
    </div>
@elseif(session('spa_profile_update_success'))
    <div class="alert alert-success rounded-3 mb-4 small">
        {{ session('spa_profile_update_success') }}
    </div>
@endif

{{-- Desktop / Large Screens --}}
<div class="card border-0 mb-4 d-none d-lg-block">

    {{-- Header --}}
    <div class="card-header bg-white border-0 py-3 px-2 d-flex justify-content-between align-items-center">
        <div class="small text-muted">Spa Profile</div>
        <input
            type="text"
            class="form-control form-control-sm"
            placeholder="Search..."
            style="max-width: 220px"
        >
    </div>

    {{-- Table --}}
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">

                <thead class="small text-muted text-uppercase fw-semibold">
                    <tr>
                        <th class="py-3 ps-3">Name</th>
                        <th class="py-3">Email</th>
                        <th class="py-3">Phone</th>
                        <th class="py-3">Logo</th>
                        <th class="py-3">Location</th>
                        <th class="py-3">Total Beds</th>
                        <th class="py-3 text-end pe-3">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="py-3 ps-3 fw-medium text-dark">{{ $profile->name }}</td>
                        <td class="py-3 text-muted small">{{ $profile->company->email }}</td>
                        <td class="py-3 text-muted small">{{ $profile->company->phone }}</td>
                        <td class="py-3">
                            @if($profile->company->logo)
                                <img src="{{ asset('storage/' . $profile->company->logo) }}" alt="Logo" class="rounded" width="50">
                            @else
                                <span class="text-muted small fst-italic">No Image</span>
                            @endif
                        </td>
                        <td class="py-3 text-muted small">{{ $profile->location }}</td>
                        <td class="py-3 text-muted small">{{ $profile->total_beds }}</td>
                        <td class="py-3 text-end pe-3">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light border rounded-3" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3">
                                    <li>
                                        <a href="#" class="dropdown-item">
                                            <i class="bi bi-eye me-2"></i>View
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="dropdown-item">
                                            <i class="bi bi-pencil me-2"></i>Edit
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
</div>

{{-- Mobile / Small Screens --}}
<div class="d-lg-none">
    <div class="card shadow-sm rounded-3 mb-3">
        <div class="card-body p-3">

            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="fw-semibold text-dark small">{{ $profile->name }}</div>

                <div class="dropdown">
                    <button class="btn btn-sm btn-light border rounded-3" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3">
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
            <div class="small mb-2">{{ $profile->company->email }}</div>

            <div class="small text-muted mb-1">Phone</div>
            <div class="small mb-2">{{ $profile->company->phone }}</div>

            <div class="small text-muted mb-1">Logo</div>
            <div class="small mb-2">
                @if($profile->company->logo)
                    <img src="{{ asset('storage/' . $profile->company->logo) }}" alt="Logo" class="rounded" width="50">
                @else
                    <span class="text-muted fst-italic">No Image</span>
                @endif
            </div>

            <div class="small text-muted mb-1">Location</div>
            <div class="small mb-2">{{ $profile->location }}</div>

            <div class="small text-muted mb-1">Total Beds</div>
            <div class="small mb-2">{{ $profile->total_beds }}</div>

        </div>
    </div>
</div>

@endsection
