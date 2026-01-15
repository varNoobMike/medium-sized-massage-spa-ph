@extends('layouts.panel.app')

@section('title', 'Manage Therapists')

@section('page-heading', 'Therapists')
@section('page-heading-small', 'Manage all your therapists here.')

@section('content')

{{-- Alerts --}}
@if($errors->any())
    <div class="alert alert-danger rounded-3 mb-4 small d-flex align-items-center gap-2">
        <i class="bi bi-exclamation-circle-fill"></i>
        {{ $errors->first() }}
    </div>
@elseif(session('approve_therapist_success'))
    <div class="alert alert-success rounded-3 mb-4 small d-flex align-items-center gap-2">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('approve_therapist_success') }}
    </div>
@endif

{{-- Desktop / Large Screens --}}
<div class="card border-0 mb-4 d-none d-lg-block">
    <div class="card-header bg-white border-0 py-3 ps-2 pe-0 d-flex justify-content-between align-items-center">
        <div class="small text-muted">{{ $therapists->count() }} {{ Str::plural('Therapist', $therapists->count()) }}</div>
        <input type="text" class="form-control form-control-sm" placeholder="Search therapists..." style="max-width: 220px;">
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="small text-muted">
                    <tr class="text-uppercase fw-semibold">
                        <th class="py-2 ps-1">Name</th>
                        <th class="py-2 ps-1">Email</th>
                        <th class="py-2 ps-1">Status</th>
                        <th class="py-2 text-end pe-1">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($therapists as $therapist)
                        <tr>
                            <td class="py-2 ps-1 fw-medium text-dark">{{ $therapist->name }}</td>
                            <td class="py-2 ps-1 text-muted small">{{ $therapist->email }}</td>
                            <td class="py-2 ps-1">
                                @if ($therapist->approved_at)
                                    <span class="badge bg-success-subtle text-success small">Approved</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-warning small">Unapproved</span>
                                @endif
                            </td>
                            <td class="py-2 text-end pe-0">
                                <div class="dropdown position-relative">
                                    <button class="btn btn-sm btn-light border rounded-3" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end rounded-3 shadow-sm">
                                        @if(!$therapist->approved_at)
                                            <li>
                                                <form action="{{ route('admin.therapists.approve', $therapist->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="dropdown-item text-success small"
                                                        onclick="return confirm('Approve this therapist?');">
                                                        <i class="bi bi-check-circle me-2"></i>Approve
                                                    </button>
                                                </form>
                                            </li>
                                        @endif
                                        <li><a href="#" class="dropdown-item small"><i class="bi bi-eye me-2"></i>View</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4 small">
                                <i class="bi bi-person-badge fs-4 d-block mb-2"></i>
                                No therapists found
                                <div class="mt-1">Therapists will appear here once they are added.</div>
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
        <div class="card shadow-sm rounded-3 mb-3">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="fw-semibold text-dark small">{{ $therapist->name }}</div>
                    <div class="dropdown position-relative">
                        <button class="btn btn-sm btn-light border rounded-3" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end rounded-3 shadow-sm">
                            @if(!$therapist->approved_at)
                                <li>
                                    <form action="{{ route('admin.therapists.approve', $therapist->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="dropdown-item text-success small"
                                            onclick="return confirm('Approve this therapist?');">
                                            <i class="bi bi-check-circle me-2"></i>Approve
                                        </button>
                                    </form>
                                </li>
                            @endif
                            <li><a href="#" class="dropdown-item small"><i class="bi bi-eye me-2"></i>View</a></li>
                        </ul>
                    </div>
                </div>

                <div class="small text-muted mb-1">Email</div>
                <div class="small mb-2">{{ $therapist->email }}</div>

                <div>
                    @if ($therapist->approved_at)
                        <span class="badge bg-success-subtle text-success small">Approved</span>
                    @else
                        <span class="badge bg-secondary-subtle text-warning small">Unapproved</span>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="text-center text-muted py-5 small">
            <i class="bi bi-person-badge fs-4 d-block mb-2"></i>
            No therapists found
            <div class="mt-1">Therapists will appear here once they are added.</div>
        </div>
    @endforelse
</div>

@endsection
