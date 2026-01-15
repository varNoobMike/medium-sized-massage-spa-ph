@extends('layouts.panel.app')

@section('title', 'Admin Dashboard')

@section('page-heading', 'Dashboard')
@section('page-heading-small', 'System overview and key operational metrics')

@section('content')

{{-- Quick Statistics --}}
<div class="row g-3 g-md-4 mb-4">

    @php
        $stats = [
            [
                'label' => 'Total Clients',
                'value' => $totalClients ?? 0,
                'icon'  => 'bi-people',
                'color' => 'primary',
                'desc'  => 'Registered client accounts'
            ],
            [
                'label' => 'Active Bookings',
                'value' => $activeBookings ?? 0,
                'icon'  => 'bi-calendar-check',
                'color' => 'success',
                'desc'  => 'Confirmed and upcoming bookings'
            ],
            [
                'label' => 'Therapists',
                'value' => $therapists ?? 0,
                'icon'  => 'bi-heart-pulse',
                'color' => 'danger',
                'desc'  => 'Currently active therapists'
            ],
            [
                'label' => 'Services',
                'value' => $services ?? 0,
                'icon'  => 'bi-list-check',
                'color' => 'warning',
                'desc'  => 'Available spa services'
            ],
        ];
    @endphp

    @foreach ($stats as $stat)
        <div class="col-6 col-md-3">
            <div class="card h-100 border shadow-sm rounded-3 p-4">

                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div>
                        <div class="text-muted small">
                            {{ $stat['label'] }}
                        </div>
                        <div class="fs-4 fw-semibold">
                            {{ number_format($stat['value']) }}
                        </div>
                    </div>

                    <div
                        class="d-flex align-items-center justify-content-center
                               bg-{{ $stat['color'] }}-subtle
                               text-{{ $stat['color'] }}
                               rounded-circle"
                        style="width:48px;height:48px"
                        aria-hidden="true"
                    >
                        <i class="bi {{ $stat['icon'] }} fs-5"></i>
                    </div>
                </div>

                <div class="small text-muted">
                    {{ $stat['desc'] }}
                </div>

            </div>
        </div>
    @endforeach

</div>

{{-- System Status Panel --}}
<div class="card border shadow-sm rounded-3 p-4 mb-4">
    <div class="d-flex align-items-center justify-content-between mb-2">
        <div class="fw-semibold">System Status</div>
        <span class="badge bg-success-subtle text-success">
            Operational
        </span>
    </div>

    <p class="small text-muted mb-0">
        All administrative modules are functioning normally.
        No critical alerts or pending system actions detected.
    </p>

    <div class="mt-3 small text-muted">
        Last updated: {{ now()->format('M d, Y • H:i') }}
    </div>
</div>

{{-- Placeholder for Future Widgets --}}
<div class="card border shadow-sm rounded-3 p-4 text-center text-muted">
    <i class="bi bi-bar-chart-line fs-3 mb-2"></i>
    <div class="fw-semibold">
        Dashboard Widgets
    </div>
    <p class="small mt-1 mb-0">
        Analytics, reports, and recent activity logs will appear here.
    </p>
</div>

@endsection
