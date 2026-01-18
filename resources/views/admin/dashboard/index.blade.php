@extends('layouts.panel.app')

@section('title', 'Admin Dashboard')

@section('page-heading', 'Dashboard')
@section('page-heading-small', 'System overview and key operational metrics')

@section('content')

@php
    $stats = [
        ['label' => 'Clients', 'value' => $totalClients ?? 0, 'icon' => 'bi-people', 'color' => 'primary', 'desc' => 'Registered client accounts'],
        ['label' => 'Bookings', 'value' => $activeBookings ?? 0, 'icon' => 'bi-calendar-check', 'color' => 'success', 'desc' => 'Confirmed and upcoming bookings'],
        ['label' => 'Therapists', 'value' => $therapists ?? 0, 'icon' => 'bi-heart-pulse', 'color' => 'danger', 'desc' => 'Currently active therapists'],
        ['label' => 'Services', 'value' => $services ?? 0, 'icon' => 'bi-list-check', 'color' => 'warning', 'desc' => 'Available spa services'],
    ];
@endphp

{{-- Desktop Stats Cards --}}
<div class="row g-3 mb-4 d-none d-lg-flex">
    @foreach ($stats as $stat)
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-lg h-100 hover-shadow">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <div class="small text-muted">{{ $stat['label'] }}</div>
                        <div class="fs-4 fw-semibold text-dark">{{ number_format($stat['value']) }}</div>
                        <div class="small text-muted mt-1">{{ $stat['desc'] }}</div>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center
                                bg-{{ $stat['color'] }}-subtle text-{{ $stat['color'] }} shadow-sm"
                         style="width:50px; height:50px;">
                        <i class="bi {{ $stat['icon'] }} fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{-- Stats --}}
<div class="d-lg-none mb-4">
    @foreach ($stats as $stat)
        <div class="card border-0 shadow-sm rounded-3 mb-3 hover-shadow">
            <div class="card-body d-flex justify-content-between align-items-center p-3">
                <div>
                    <div class="small text-muted">{{ $stat['label'] }}</div>
                    <div class="fs-5 fw-semibold text-dark">{{ number_format($stat['value']) }}</div>
                    <div class="small text-muted mt-1">{{ $stat['desc'] }}</div>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center
                            bg-{{ $stat['color'] }}-subtle text-{{ $stat['color'] }} shadow-sm"
                     style="width:40px; height:40px;">
                    <i class="bi {{ $stat['icon'] }} fs-5"></i>
                </div>
            </div>
        </div>
    @endforeach
</div>


{{-- System Status --}}
<div class="card border-0 shadow-sm rounded-lg mb-4 hover-shadow">
    <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <div class="fw-medium text-dark">System status</div>
            <span class="badge bg-success-subtle text-success fw-semibold py-1 px-2 small">Operational</span>
        </div>
        <p class="small text-muted mb-2">All administrative modules are functioning normally. No action is required at this time.</p>
        <div class="small text-muted">Last updated {{ now()->diffForHumans() }}</div>
    </div>
</div>

{{-- Analytics / Empty State --}}
<div class="card border-0 shadow-sm rounded-lg p-4 text-center hover-shadow">
    <div class="mb-3 text-muted opacity-75"><i class="bi bi-bar-chart-line fs-2"></i></div>
    <div class="fw-medium text-dark">No analytics available</div>
    <p class="small text-muted mt-2 mb-0">Reports, charts, and recent activity will appear here once data is available.</p>
</div>

@endsection
