@extends('layouts.admin.app')

@section('title', 'Manage Services')

@section('breadcrumb')
@foreach ($breadcrumbs as $crumb)
    @if ($crumb['url'])
        <li class="breadcrumb-item">
            <a href="{{ $crumb['url'] }}" class="text-dark">
                <span class="small">{{ $crumb['title'] }}</span>
            </a>
        </li>
    @else
        <li class="breadcrumb-item active" aria-current="page">
            <span class="small">{{ $crumb['title'] }}</span>
        </li>
    @endif
@endforeach
@endsection

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

    {{-- Header --}}
    <div class="card-header bg-white border-0 py-3 ps-2 pe-0 d-flex justify-content-between align-items-center">
        <div class="small text-muted">{{ $services->count() }} services</div>
        <input type="text" class="form-control form-control-sm" placeholder="Search service..." style="max-width: 220px;">
    </div>

    {{-- Table --}}
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead class="small text-muted">
                    <tr class="text-uppercase fw-semibold">
                        <th class="py-3 ps-3">Name</th>
                        <th class="py-3 ps-3">Duration</th>
                        <th class="py-3 ps-3">Price</th>
                        <th class="py-3 text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($services as $service)
                    <tr>
                        <td class="py-3 ps-3 fw-medium text-dark">{{ $service->name }}</td>
                        <td class="py-3 ps-3 text-muted small">{{ $service->duration_minutes }} mins</td>
                        <td class="py-3 ps-3 fw-medium">{{ number_format($service->price, 2) }}</td>
                        <td class="py-3 text-end pe-3">
                            <div class="dropdown position-relative">
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
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a href="#" class="dropdown-item small text-danger">
                                            <i class="bi bi-trash me-2"></i>Delete
                                        </a>
                                    </li>
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
                        <li>
                            <a href="#" class="dropdown-item small text-danger">
                                <i class="bi bi-trash me-2"></i>Delete
                            </a>
                        </li>
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
