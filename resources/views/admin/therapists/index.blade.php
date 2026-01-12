@extends('layouts.admin.app')

@section('title', 'Manage Therapists')

@section('page-heading', 'Therapists')
@section('page-heading-small', 'Manage all your therapists here.')

@section('content')

{{-- Alerts --}}
@if ($errors->any())
<div class="alert alert-danger rounded-3 mb-4 small d-flex align-items-center gap-2">
    <i class="bi bi-exclamation-circle-fill"></i>
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@elseif(session('therapist_approve_success'))
<div class="alert alert-success rounded-3 mb-4 small d-flex align-items-center gap-2">
    <i class="bi bi-check-circle-fill"></i>
    {{ session('therapist_approve_success') }}
</div>
@endif

{{-- Desktop / Large Screens --}}
<div class="card border-0 mb-4 d-none d-lg-block">

    {{-- Header --}}
    <div class="card-header bg-white border-0 py-3 ps-2 pe-0 d-flex justify-content-between align-items-center">
        <div class="small text-muted">{{ $therapists->count() }} therapists</div>
        <input
            type="text"
            class="form-control form-control-sm"
            placeholder="Search therapist..."
            style="max-width: 220px;"
        >
    </div>

    {{-- Table --}}
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead class="small text-muted">
                    <tr class="text-uppercase fw-semibold">
                        <th class="py-3 ps-3">Name</th>
                        <th class="py-3 ps-3">Email</th>
                        <th class="py-3 ps-3">Email Verified</th>
                        <th class="py-3 ps-3">Approved</th>
                        <th class="py-3 text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($therapists as $therapist)
                    <tr>
                        <td class="py-3 ps-3 fw-medium text-dark align-middle">{{ $therapist->name }}</td>
                        <td class="py-3 ps-3 text-muted small align-middle">{{ $therapist->email }}</td>
                        <td class="py-3 ps-3 align-middle">
                            @if ($therapist->email_verified_at)
                                <span class="badge bg-success-subtle text-success small">Verified</span>
                            @else
                                <span class="badge bg-secondary-subtle text-muted small">Unverified</span>
                            @endif
                        </td>
                        <td class="py-3 ps-3 align-middle">
                            @if ($therapist->approved_at)
                                <span class="badge bg-success-subtle text-success small">Approved</span>
                            @else
                                <span class="badge bg-secondary-subtle text-muted small">Unapproved</span>
                            @endif
                        </td>
                        <td class="py-3 text-end pe-3 align-middle">
                            <div class="dropdown position-relative">
                                <button class="btn btn-sm btn-light border" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3">
                                    @if(!$therapist->approved_at)
                                        <li>
                                            <form action="{{ route('admin.therapists.approve', $therapist->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="dropdown-item text-success" 
                                                    onclick="return confirm('Approve this therapist?');">
                                                    <i class="bi bi-check-circle me-2"></i>Approve
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="#" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" 
                                                    onclick="return confirm('Decline this therapist?');">
                                                    <i class="bi bi-x-circle me-2"></i>Decline
                                                </button>
                                            </form>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                    @endif

                                    <li>
                                        <a href="#" class="dropdown-item">
                                            <i class="bi bi-eye me-2"></i>View
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4 small">
                            <i class="bi bi-person-badge fs-4 d-block mb-2"></i>
                            No therapists found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Mobile / Small Screens --}}
<div class="d-lg-none">
@forelse ($therapists as $therapist)
    <div class="card shadow-sm mb-3">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div class="fw-semibold text-dark small">{{ $therapist->name }}</div>

                <div class="dropdown position-relative">
                    <button class="btn btn-sm btn-light border" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3">
                        @if(!$therapist->approved_at)
                            <li>
                                <form action="{{ route('admin.therapists.approve', $therapist->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="dropdown-item text-success"
                                        onclick="return confirm('Approve this therapist?');">
                                        <i class="bi bi-check-circle me-2"></i>Approve
                                    </button>
                                </form>
                            </li>
                            <li>
                                <form action="#" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger"
                                        onclick="return confirm('Decline this therapist?');">
                                        <i class="bi bi-x-circle me-2"></i>Decline
                                    </button>
                                </form>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                        @endif

                        <li>
                            <a href="#" class="dropdown-item">
                                <i class="bi bi-eye me-2"></i>View
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="small text-muted mb-1">Email</div>
            <div class="small mb-2">{{ $therapist->email }}</div>

            <div>
                @if ($therapist->email_verified_at)
                    <span class="badge bg-success-subtle text-success small">Verified</span>
                @else
                    <span class="badge bg-secondary-subtle text-muted small">Unverified</span>
                @endif

                @if ($therapist->approved_at)
                    <span class="badge bg-success-subtle text-success small ms-1">Approved</span>
                @else
                    <span class="badge bg-secondary-subtle text-muted small ms-1">Unapproved</span>
                @endif
            </div>
        </div>
    </div>
@empty
    <div class="text-center text-muted py-5 small">
        <i class="bi bi-person-badge fs-4 d-block mb-2"></i>
        No therapists found.
    </div>
@endforelse
</div>

@endsection
