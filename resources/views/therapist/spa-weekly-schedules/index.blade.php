@extends('layouts.panel.app')

@section('title', 'Spa Weekly Schedules')

@section('page-heading', 'Spa Weekly Schedules')
@section('page-heading-small', 'View the spa’s available weekly time slots.')

@section('content')

{{-- Read-only Notice --}}
<div class="alert alert-info rounded-3 mb-4 small d-flex align-items-center gap-2">
    <i class="bi bi-info-circle-fill opacity-75"></i>
    <span>
        Weekly schedules are managed by the administrator.
        This page is view-only for therapists.
    </span>
</div>

{{-- ========================= --}}
{{-- Desktop Table (Read-only) --}}
{{-- ========================= --}}
<div class="table-responsive mb-4 d-none d-lg-block">
    <table class="table table-hover align-middle mb-0">
        <thead class="table-light text-uppercase text-secondary small fw-semibold">
            <tr>
                <th class="ps-3 py-2">Day</th>
                <th class="py-2 text-center">Time Slots</th>
            </tr>
        </thead>

        <tbody>
        @forelse($schedules as $dayOfWeek => $timeSlots)
            <tr>
                {{-- Day --}}
                <td class="ps-3 fw-medium text-dark py-2">
                    {{ $dayOfWeek }}
                </td>

                {{-- Time Slots --}}
                <td class="p-0">
                    <table class="table table-sm table-borderless mb-0">
                        <thead class="small text-muted">
                            <tr>
                                <th class="ps-3">Start</th>
                                <th>End</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($timeSlots as $slot)
                            <tr class="border-top">
                                <td class="ps-3">
                                    {{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2"
                                    class="text-center text-muted fst-italic py-3">
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
                    class="text-center text-muted fst-italic py-4">
                    No weekly schedules found
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

{{-- ========================= --}}
{{-- Mobile Cards (Read-only) --}}
{{-- ========================= --}}
<div class="d-lg-none">
@forelse($schedules as $dayOfWeek => $timeSlots)
    <div class="card border rounded-3 mb-3 shadow-sm hover-shadow">
        <div class="card-body p-3">

            <div class="fw-semibold text-dark mb-2">
                {{ $dayOfWeek }}
            </div>

            @forelse($timeSlots as $slot)
                <div class="d-flex justify-content-between align-items-center py-2 border-top small text-muted">
                    <div>
                        {{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }}
                        –
                        {{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }}
                    </div>
                </div>
            @empty
                <div class="text-muted fst-italic py-2">
                    No time slots yet
                </div>
            @endforelse

        </div>
    </div>
@empty
    <div class="text-center text-muted fst-italic py-5">
        No weekly schedules found
    </div>
@endforelse
</div>

@endsection
