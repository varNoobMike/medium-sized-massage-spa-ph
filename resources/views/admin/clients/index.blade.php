@extends('layouts.panel.app')

@section('title', 'Manage Clients')

@section('page-heading', 'Clients')
@section('page-heading-small', 'Manage all your clients here.')

@section('content')

{{-- Alerts --}}
@if($errors->any())
    <div class="alert alert-danger rounded-3 mb-4 small d-flex align-items-center gap-2">
        <i class="bi bi-exclamation-circle-fill"></i>
        {{ $errors->first() }}
    </div>
@elseif(session('approve_client_success'))
    <div class="alert alert-success rounded-3 mb-4 small d-flex align-items-center gap-2">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('approve_client_success') }}
    </div>
@endif

{{-- Desktop / Large Screens --}}
<div class="card border-0 mb-4 d-none d-lg-block">
    <div class="card-header bg-white border-0 py-3 ps-2 pe-0 d-flex justify-content-between align-items-center">
        <div class="small text-muted">{{ $clients->count() }} {{ Str::plural('Client', $clients->count()) }}</div>
        <input type="text" class="form-control form-control-sm" placeholder="Search clients..." style="max-width: 220px;">
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
                    @forelse ($clients as $client)
                        <tr>
                            <td class="py-2 ps-1 fw-medium text-dark">{{ $client->name }}</td>
                            <td class="py-2 ps-1 text-muted small">{{ $client->email }}</td>
                            <td class="py-2 ps-1">
                                @if ($client->email_verified_at)
                                    <span class="badge bg-success-subtle text-success small">Verified</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-warning small">Unverified</span>
                                @endif
                            </td>
                            <td class="py-2 text-end pe-0">
                                <div class="dropdown position-relative">
                                    <button class="btn btn-sm btn-light border rounded-3" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end rounded-3 shadow-sm">
                                        <li><a href="#" class="dropdown-item small"><i class="bi bi-eye me-2"></i>View</a></li>
                                        @if(!$client->email_verified_at)
                                            <li>
                                                <form action="#" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="dropdown-item text-success small"
                                                        onclick="return confirm('Approve this client?');">
                                                        <i class="bi bi-check-circle me-2"></i>Approve
                                                    </button>
                                                </form>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4 small">
                                <i class="bi bi-people fs-4 d-block mb-2"></i>
                                No clients found
                                <div class="mt-1">Clients will appear here once they register.</div>
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
    @forelse ($clients as $client)
        <div class="card shadow-sm rounded-3 mb-3">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="fw-semibold text-dark small">{{ $client->name }}</div>
                    <div class="dropdown position-relative">
                        <button class="btn btn-sm btn-light border rounded-3" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end rounded-3 shadow-sm">
                            <li><a href="#" class="dropdown-item small"><i class="bi bi-eye me-2"></i>View</a></li>
                            @if(!$client->email_verified_at)
                                <li>
                                    <form action="#" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="dropdown-item text-success small"
                                            onclick="return confirm('Approve this client?');">
                                            <i class="bi bi-check-circle me-2"></i>Approve
                                        </button>
                                    </form>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="small text-muted mb-1">Email</div>
                <div class="small mb-2">{{ $client->email }}</div>

                <div>
                    @if ($client->email_verified_at)
                        <span class="badge bg-success-subtle text-success small">Verified</span>
                    @else
                        <span class="badge bg-secondary-subtle text-warning small">Unverified</span>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="text-center text-muted py-5 small">
            <i class="bi bi-people fs-4 d-block mb-2"></i>
            No clients found
            <div class="mt-1">Clients will appear here once they register.</div>
        </div>
    @endforelse
</div>

@endsection
