@extends('layouts.admin.app')

@section('title', 'Admin Dashboard')

@section('breadcrumb')
@foreach ($breadcrumbs as $crumb)
    @if ($crumb['url'])
        <li class="breadcrumb-item">
            <a href="{{ $crumb['url'] }}" class="text-dark">
                <span class="small">{{ $crumb['title'] }}</span>
            </a>
        </li>
    @else
        <li class="breadcrumb-item active">
            <span class="small">{{ $crumb['title'] }}</span>
        </li>
    @endif
@endforeach
@endsection

@section('page-heading', 'Dashboard')
@section('page-heading-small', 'Welcome back! Here is your overview.')

@section('content')

{{-- Quick Stats --}}
<div class="row g-3 g-md-4 mb-4">

    @php
        $stats = [
            ['label' => 'Total Clients', 'value' => 0, 'icon' => 'bi-people', 'color' => 'primary'],
            ['label' => 'Active Bookings', 'value' => 0, 'icon' => 'bi-calendar-check', 'color' => 'success'],
            ['label' => 'Therapists', 'value' => 0, 'icon' => 'bi-heart-pulse', 'color' => 'danger'],
            ['label' => 'Services', 'value' => 0, 'icon' => 'bi-list-check', 'color' => 'warning'],
        ];
    @endphp

    @foreach ($stats as $stat)
        <div class="col-6 col-md-3">
            <div class="card shadow-sm rounded-3 p-4 h-100 d-flex flex-column justify-content-between">
                <div class="d-flex align-items-center justify-content-between">
                    {{-- Left: Stat Label & Value --}}
                    <div>
                        <div class="text-secondary small">{{ $stat['label'] }}</div>
                        <div class="fs-4 fw-bold">{{ $stat['value'] }}</div>
                    </div>

                    {{-- Right: Icon in circle --}}
                    <div class="d-flex align-items-center justify-content-center bg-{{ $stat['color'] }}-subtle text-{{ $stat['color'] }} rounded-circle" style="width:50px; height:50px;">
                        <i class="bi {{ $stat['icon'] }} fs-4"></i>
                    </div>
                </div>

                {{-- Optional: Placeholder or progress --}}
                <div class="mt-3">
                    <div class="progress rounded-3" style="height:6px;">
                        <div class="progress-bar bg-{{ $stat['color'] }}" role="progressbar" style="width: {{ rand(20,100) }}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>

{{-- Placeholder Panel --}}
<div class="card border-dashed rounded-3 p-4 text-center text-muted">
    <i class="bi bi-speedometer2 fs-3 mb-2"></i>
    <div class="fw-semibold">Dashboard widgets will appear here</div>
    <p class="small mt-1">Quick stats, charts, and recent activity will be displayed here.</p>
</div>

@endsection
