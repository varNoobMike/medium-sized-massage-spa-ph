@extends('layouts.panel.app')

@section('title', 'Spa Weekly Schedules')

@section('page-heading', 'Spa Weekly Schedules')
@section('page-heading-small', 'View the spa’s available weekly time slots.')

@section('content')

{{-- Info Alert (Read-only Notice) --}}
<div class="alert alert-info rounded-3 mb-4 small d-flex align-items-center gap-2">
    <i class="bi bi-info-circle-fill"></i>
    <span>
        Weekly schedules are managed by the administrator.
        This page is view-only for therapists.
    </span>
</div>

{{-- ============================== --}}
{{-- Desktop / Large Screens --}}
{{-- ============================== --}}
<div class="card border-0 mb-4 d-none d-lg-block">
    <div class="card-header bg-white border-0 py-3 ps-2 pe-0">
        <div class="small text-muted">
            {{ count($schedules) }} days scheduled
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="small text-muted text-uppercase fw-semibold">
                    <tr>
                        <th class="py-2 ps-1">Day of Week</th>
                        <th class="py-2 text-center">Time Slots</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($schedules as $dayOfWeek => $timeSlots)
                    <tr>
                        <td class="py-2 ps-1 fw-medium text-dark align-middle">
                            {{ $dayOfWeek }}
                        </td>

                        <td class="py-2 p-0">
                            <table class="table table-hover table-borderless table-sm mb-0">
                                <thead class="small text-muted">
                                    <tr>
                                        <th class="ps-3">Start</th>
                                        <th class="ps-3">End</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @forelse($timeSlots as $slot)
                                    <tr class="align-middle border-bottom">
                                        <td class="ps-3">
                                            {{ \Carbon\Carbon::parse($slot->start_time)->format('g:i A') }}
                                        </td>
                                        <td class="ps-3">
                                            {{ \Carbon\Carbon::parse($slot->end_time)->format('g:i A') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2"
                                            class="text-center small text-muted fst-italic py-2">
                                            No time slots yet
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2"
                            class="text-center small text-muted fst-italic py-4">
                            No weekly schedules found
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
@forelse($schedules as $dayOfWeek => $timeSlots)
    <div class="card shadow-sm rounded-3 mb-3">
        <div class="card-body p-3">

            <div class="fw-semibold text-dark small mb-2">
                {{ $dayOfWeek }}
            </div>

            @forelse($timeSlots as $slot)
                <div class="d-flex justify-content-between align-items-center
                            small text-muted border-bottom py-2">
                    <div>
                        {{ \Carbon\Carbon::parse($slot->start_time)->format('g:i A') }}
                        –
                        {{ \Carbon\Carbon::parse($slot->end_time)->format('g:i A') }}
                    </div>
                </div>
            @empty
                <div class="small fst-italic text-muted py-2">
                    No time slots yet
                </div>
            @endforelse

        </div>
    </div>
@empty
    <div class="text-center small text-muted fst-italic py-5">
        No weekly schedules found
    </div>
@endforelse
</div>

@endsection
