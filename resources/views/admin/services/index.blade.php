@extends('layouts.panel.app')

@section('title', 'Manage Services')

@section('page-heading', 'Services')
@section('page-heading-small', 'Manage all available services.')

@section('content')

{{-- Alerts --}}
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-3 small d-flex align-items-center gap-2" role="alert">
        <i class="bi bi-exclamation-circle-fill fs-5 opacity-75"></i>
        <div>{{ $errors->first() }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif(session('update_service_success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3 mb-3 small d-flex align-items-center gap-2" role="alert">
        <i class="bi bi-check-circle-fill fs-5 opacity-75"></i>
        <div>{{ session('update_service_success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Table (Desktop) --}}
<div class="table-responsive mb-4 d-none d-lg-block">
    <table class="table table-hover align-middle mb-0 small">
        <thead class="table-light text-uppercase text-secondary fw-semibold">
            <tr>
                <th class="ps-3 py-2">Name</th>
                <th class="py-2">Duration</th>
                <th class="py-2">Price</th>
                <th class="py-2 text-end pe-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($services as $service)
                <tr class="hover-bg-light">
                    <td class="ps-3 fw-medium text-dark py-2">{{ $service->name }}</td>
                    <td class="text-muted py-2">{{ $service->duration_minutes }} mins</td>
                    <td class="fw-medium py-2">${{ number_format($service->price, 2) }}</td>
                    <td class="text-end pe-3 py-2">
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm p-1 border rounded-3" data-bs-toggle="dropdown" aria-label="Service actions">
                                <i class="bi bi-three-dots fs-6"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end rounded-3 shadow-sm">
                                <li>
                                    <a class="dropdown-item small d-flex align-items-center gap-2 py-1" href="#">
                                        <i class="bi bi-eye fs-6"></i> View
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item small d-flex align-items-center gap-2 py-1" href="#">
                                        <i class="bi bi-pencil fs-6"></i> Edit
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider my-1"></li>
                                <li>
                                    <a class="dropdown-item small text-danger d-flex align-items-center gap-2 py-1" href="#">
                                        <i class="bi bi-trash fs-6"></i> Delete
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



{{-- Mobile Cards --}}
<div class="d-lg-none">
    @forelse ($services as $service)
        <div class="card border rounded-3 mb-3 shadow-sm hover-shadow">
            <div class="card-body p-3 d-flex justify-content-between align-items-start">
                <div>
                    <div class="fw-semibold text-dark">{{ $service->name }}</div>
                    <div class="small text-muted mt-1">Duration: {{ $service->duration_minutes }} mins</div>
                    <div class="small text-muted mt-1">Price: {{ number_format($service->price, 2) }}</div>
                </div>
                <div class="dropdown flex-shrink-0">
                    <button class="btn btn-light btn-sm p-1 border rounded-3" data-bs-toggle="dropdown" aria-label="Service actions">
                        <i class="bi bi-three-dots fs-6"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end rounded-3 shadow-sm">
                        <li>
                            <a class="dropdown-item small d-flex align-items-center gap-2 py-1" href="#"><i class="bi bi-eye fs-6"></i> View</a>
                        </li>
                        <li>
                            <a class="dropdown-item small d-flex align-items-center gap-2 py-1" href="#"><i class="bi bi-pencil fs-6"></i> Edit</a>
                        </li>
                        <li>
                            <a class="dropdown-item small text-danger d-flex align-items-center gap-2 py-1" href="#"><i class="bi bi-trash fs-6"></i> Delete</a>
                        </li>
                    </ul>
                </div>
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
