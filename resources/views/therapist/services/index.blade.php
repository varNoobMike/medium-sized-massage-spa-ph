@extends('layouts.panel.app')

@section('title', 'Spa Services')

@section('page-heading', 'Spa Services')
@section('page-heading-small', 'View the list of services offered by the spa.')

@section('content')

{{-- Info Alert (Read-only Notice) --}}
<div class="alert alert-info rounded-3 mb-4 small d-flex align-items-center gap-2">
    <i class="bi bi-info-circle-fill"></i>
    <span>
        Spa services are managed by the administrator.
        This page is view-only for therapists.
    </span>
</div>

{{-- ============================== --}}
{{-- Desktop / Large Screens --}}
{{-- ============================== --}}
<div class="card border-0 mb-4 d-none d-lg-block">
    <div class="card-header bg-white border-0 py-3 ps-2 pe-0">
        <div class="small text-muted">
            {{ $services->count() }} services available
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="small text-muted text-uppercase fw-semibold">
                    <tr>
                        <th class="py-2 ps-3">Service Name</th>
                        <th class="py-2 text-center">Duration</th>
                        <th class="py-2 text-end pe-3">Price</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($services as $service)
                    <tr>
                        <td class="ps-3 fw-medium text-dark">
                            {{ $service->name }}
                        </td>

                        <td class="text-center text-muted">
                            {{ $service->duration_minutes }} mins
                        </td>

                        <td class="text-end pe-3 fw-semibold">
                            {{ number_format($service->price, 2) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3"
                            class="text-center small text-muted fst-italic py-4">
                            No services found
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ============================== --}}
{{-- Mobile / Small Screens --}}
{{-- ============================== --}}
<div class="d-lg-none">
@forelse($services as $service)
    <div class="card shadow-sm rounded-3 mb-3">
        <div class="card-body p-3">

            <div class="fw-semibold text-dark mb-1">
                {{ $service->name }}
            </div>

            <div class="small text-muted d-flex justify-content-between">
                <span>
                    <i class="bi bi-clock me-1"></i>
                    {{ $service->duration_minutes }} mins
                </span>

                <span class="fw-semibold">
                    {{ number_format($service->price, 2) }}
                </span>
            </div>

        </div>
    </div>
@empty
    <div class="text-center small text-muted fst-italic py-5">
        No services found
    </div>
@endforelse
</div>

@endsection
