@extends('layouts.panel.app')

@section('title', 'Spa Services')

@section('page-heading', 'Spa Services')
@section('page-heading-small', 'View available spa services.')

@section('content')

{{-- Read-only Info Alert --}}
<div class="alert alert-info rounded-3 mb-4 small d-flex align-items-center gap-2">
    <i class="bi bi-info-circle-fill opacity-75"></i>
    <span>
        Services are managed by the administrator.
        This page is read-only for therapists.
    </span>
</div>

{{-- ============================== --}}
{{-- Desktop Table --}}
{{-- ============================== --}}
<div class="table-responsive mb-4 d-none d-lg-block">
    <table class="table table-hover align-middle mb-0 small">
        <thead class="table-light text-uppercase text-secondary fw-semibold">
            <tr>
                <th class="ps-3 py-2">Name</th>
                <th class="py-2">Duration</th>
                <th class="py-2 text-end pe-3">Price</th>
            </tr>
        </thead>

        <tbody>
        @forelse ($services as $service)
            <tr class="hover-bg-light">
                <td class="ps-3 fw-medium text-dark py-2">
                    {{ $service->name }}
                </td>

                <td class="text-muted py-2">
                    {{ $service->duration_minutes }} mins
                </td>

                <td class="fw-medium text-end pe-3 py-2">
                    {{ number_format($service->price, 2) }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center text-muted py-4 small">
                    <i class="bi bi-gear fs-4 d-block mb-2"></i>
                    No services found
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

{{-- ============================== --}}
{{-- Mobile Cards --}}
{{-- ============================== --}}
<div class="d-lg-none">
@forelse ($services as $service)
    <div class="card border rounded-3 mb-3 shadow-sm">
        <div class="card-body p-3">
            <div class="fw-semibold text-dark">
                {{ $service->name }}
            </div>

            <div class="small text-muted mt-1">
                Duration: {{ $service->duration_minutes }} mins
            </div>

            <div class="small fw-medium mt-1">
                {{ number_format($service->price, 2) }}
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
