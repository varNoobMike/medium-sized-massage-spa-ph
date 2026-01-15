@extends('layouts.panel.app')

@section('title', 'Manage Services')

@section('page-heading', 'Services')
@section('page-heading-small', 'Manage all available services.')

@section('content')

{{-- Alerts --}}
@if($errors->any())
    <div class="alert alert-danger rounded-3 mb-4 small d-flex align-items-center gap-2">
        <i class="bi bi-exclamation-circle-fill"></i>
        {{ $errors->first() }}
    </div>
@elseif(session('update_service_success'))
    <div class="alert alert-success rounded-3 mb-4 small d-flex align-items-center gap-2">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('update_service_success') }}
    </div>
@endif

{{-- Desktop / Large Screens --}}
<div class="card border-0 mb-4 d-none d-lg-block">
    <div class="card-header bg-white border-0 py-3 ps-2 pe-0 d-flex justify-content-between align-items-center">
        <div class="small text-muted">{{ $services->count() }} {{ Str::plural('Service', $services->count()) }}</div>
        <input type="text" class="form-control form-control-sm" placeholder="Search services..." style="max-width: 220px;">
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="small text-muted">
                    <tr class="text-uppercase fw-semibold">
                        <th class="py-2 ps-1">Name</th>
                        <th class="py-2 ps-1">Duration</th>
                        <th class="py-2 ps-1">Price</th>
                        <th class="py-2 text-end pe-1">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($services as $service)
                        <tr>
                            <td class="py-2 ps-1 fw-medium text-dark">{{ $service->name }}</td>
                            <td class="py-2 ps-1 text-muted small">{{ $service->duration_minutes }} mins</td>
                            <td class="py-2 ps-1 fw-medium">{{ number_format($service->price, 2) }}</td>
                            <td class="py-2 text-end pe-0">
                                <div class="dropdown position-relative">
                                    <button class="btn btn-sm btn-light border rounded-3" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end rounded-3 shadow-sm">
                                        <li><a href="#" class="dropdown-item small"><i class="bi bi-eye me-2"></i>View</a></li>
                                        <li><a href="#" class="dropdown-item small"><i class="bi bi-pencil me-2"></i>Edit</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a href="#" class="dropdown-item small text-danger"><i class="bi bi-trash me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4 small">
                                <i class="bi bi-gear fs-4 d-block mb-2"></i>
                                No services found
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
    @forelse ($services as $service)
        <div class="card shadow-sm rounded-3 mb-3">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="fw-semibold text-dark small">{{ $service->name }}</div>
                    <div class="dropdown position-relative">
                        <button class="btn btn-sm btn-light border rounded-3" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end rounded-3 shadow-sm">
                            <li><a href="#" class="dropdown-item small"><i class="bi bi-eye me-2"></i>View</a></li>
                            <li><a href="#" class="dropdown-item small"><i class="bi bi-pencil me-2"></i>Edit</a></li>
                            <li><a href="#" class="dropdown-item small text-danger"><i class="bi bi-trash me-2"></i>Delete</a></li>
                        </ul>
                    </div>
                </div>

                <div class="small text-muted mb-1">Duration</div>
                <div class="small mb-2">{{ $service->duration_minutes }} mins</div>

                <div class="small text-muted mb-1">Price</div>
                <div class="small fw-medium">{{ number_format($service->price, 2) }}</div>
            </div>
        </div>
    @empty
        <div class="text-center text-muted py-5 small">
            <i class="bi bi-gear fs-4 d-block mb-2"></i>
            No services found
        </div>
    @endforelse
</div>

@endsection
