@extends('layouts.panel.app')

@section('title', 'Manage Clients')

@section('page-heading', 'Clients')
@section('page-heading-small', 'Manage all your clients here.')

@section('content')

{{-- Alerts --}}
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-3 small d-flex align-items-center gap-2" role="alert">
        <i class="bi bi-exclamation-circle-fill fs-5 opacity-75"></i>
        <div>{{ $errors->first() }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif(session('approve_client_success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3 mb-3 small d-flex align-items-center gap-2" role="alert">
        <i class="bi bi-check-circle-fill fs-5 opacity-75"></i>
        <div>{{ session('approve_client_success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Table (Desktop) --}}
<div class="table-responsive mb-4 d-none d-lg-block">
    <table class="table table-hover align-middle mb-0 small">
        <thead class="table-light text-uppercase text-secondary fw-semibold">
            <tr>
                <th class="ps-3 py-2">Name</th>
                <th class="py-2">Email</th>
                <th class="py-2">Status</th>
                <th class="py-2 text-end pe-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clients as $client)
                <tr class="hover-bg-light">
                    <td class="ps-3 fw-medium text-dark py-2">{{ $client->name }}</td>
                    <td class="text-muted py-2">{{ $client->email }}</td>
                    <td class="py-2">
                        @if($client->email_verified_at)
                            <span class="badge bg-success text-white fw-semibold py-1 px-2 small">Verified</span>
                        @else
                            <span class="badge bg-warning-subtle text-dark fw-semibold py-1 px-2 small">Unverified</span>
                        @endif
                    </td>
                    <td class="text-end pe-3 py-2">
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm p-1 border rounded-3" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots fs-6"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end rounded-3 shadow-sm">
                                <li>
                                    <a class="dropdown-item small d-flex align-items-center gap-2 py-1" href="#">
                                        <i class="bi bi-eye fs-6"></i> View
                                    </a>
                                </li>
                                @if(!$client->email_verified_at)
                                    <li>
                                        <form method="POST" action="#">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="dropdown-item small text-success d-flex align-items-center gap-2 py-1" onclick="return confirm('Approve this client?');">
                                                <i class="bi bi-check-circle fs-6"></i> Approve
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



{{-- Mobile Cards --}}
<div class="d-lg-none">
    @forelse ($clients as $client)
        <div class="card border rounded-3 mb-3 shadow-sm hover-shadow">
            <div class="card-body p-3 d-flex justify-content-between align-items-start">
                <div class="flex-grow-1 me-3">
                    <div class="fw-semibold text-dark">{{ $client->name }}</div>
                    <div class="small text-muted">{{ $client->email }}</div>
                    <div class="mt-1">
                        @if($client->email_verified_at)
                            <span class="badge bg-success text-white fw-semibold py-1 px-2 small">Verified</span>
                        @else
                            <span class="badge bg-warning-subtle text-dark fw-semibold py-1 px-2 small">Unverified</span>
                        @endif
                    </div>
                </div>
                <div class="dropdown flex-shrink-0">
                    <button class="btn btn-light btn-sm p-1 border rounded-3" data-bs-toggle="dropdown" aria-label="Client actions">
                        <i class="bi bi-three-dots fs-5"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end rounded-3 shadow-sm">
                        <li>
                            <a class="dropdown-item small d-flex align-items-center gap-2 py-1" href="#"><i class="bi bi-eye fs-6"></i> View</a>
                        </li>
                        @if(!$client->email_verified_at)
                            <li>
                                <form method="POST" action="#">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="dropdown-item small text-success d-flex align-items-center gap-2 py-1" onclick="return confirm('Approve this client?');">
                                        <i class="bi bi-check-circle fs-6"></i> Approve
                                    </button>
                                </form>
                            </li>
                        @endif
                    </ul>
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
