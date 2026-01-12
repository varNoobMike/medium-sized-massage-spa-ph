@extends('layouts.admin.app')

@section('title', 'Manage Spa Weekly Schedules')

@section('page-heading', 'Spa Weekly Schedules')
@section('page-heading-small', "Manage spa's weekly schedule slots here.")

@section('content')
<div x-data="{
    loading: false,
    form: { schedule_id: null, day_of_week: '', start_time: '', end_time: '' }
}">

    {{-- Alerts --}}
    @php
        $keys = ['start_time', 'end_time', 'spa_weekly_schedule_update_error'];
    @endphp
    @if ($errors->any())
        <div class="alert alert-danger rounded-3 mb-4 small d-flex align-items-center gap-2">
            <i class="bi bi-exclamation-circle-fill"></i>
            <ul class="list-unstyled mb-0 ps-0">
                @foreach ($errors->messages() as $field => $messages)
                    @if (in_array($field, $keys))
                        @foreach ($messages as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    @endif
                @endforeach
            </ul>
        </div>
    @elseif(session('spa_weekly_schedule_update_success') || session('spa_weekly_schedule_create_success'))
        <div class="alert alert-success rounded-3 mb-4 small d-flex align-items-center gap-2">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('spa_weekly_schedule_update_success') ?? session('spa_weekly_schedule_create_success') }}
        </div>
    @endif

    {{-- Desktop / Large Screens --}}
    <div class="card border-0 mb-4 d-none d-lg-block">
        {{-- Header --}}
        <div class="card-header bg-white border-0 py-3 px-2 pe-0 d-flex justify-content-between align-items-center">
            <div class="small text-muted">{{ count($schedules) }} days scheduled</div>
            <input type="text" class="form-control form-control-sm" placeholder="Search day..." style="max-width: 220px;">
        </div>

        {{-- Table --}}
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="small text-muted text-uppercase fw-semibold">
                        <tr>
                            <th class="py-3 ps-3">Day of Week</th>
                            <th class="py-3 text-center">Time Slots</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($schedules as $dayOfWeek => $timeSlots)
                            <tr>
                                <td class="py-3 ps-3 fw-medium text-dark align-middle">{{ $dayOfWeek }}</td>
                                <td class="py-3 p-0">
                                    <table class="table table-hover table-borderless table-sm mb-0">
                                        <thead class="small text-muted">
                                            <tr>
                                                <th class="ps-3">Start</th>
                                                <th class="ps-3">End</th>
                                                <th class="text-end pe-3">
                                                    <button class="btn btn-sm btn-success rounded-3 px-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#spa-weekly-schedule-create-modal"
                                                        @click="form.day_of_week='{{ $dayOfWeek }}'">
                                                        <i class="bi bi-plus-lg"></i> Add
                                                    </button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($timeSlots as $slot)
                                                <tr class="align-middle border-bottom">
                                                    <td class="ps-3">{{ \Carbon\Carbon::parse($slot->start_time)->format('g:i A') }}</td>
                                                    <td class="ps-3">{{ \Carbon\Carbon::parse($slot->end_time)->format('g:i A') }}</td>
                                                    <td class="text-end pe-3">
                                                        <div class="dropdown position-relative">
                                                            <button class="btn btn-sm btn-light border rounded-3" data-bs-toggle="dropdown">
                                                                <i class="bi bi-three-dots"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3">
                                                                <li>
                                                                    <button class="dropdown-item"><i class="bi bi-eye me-2"></i>View</button>
                                                                </li>
                                                                <li>
                                                                    <button class="dropdown-item" data-bs-toggle="modal"
                                                                        data-bs-target="#spa-weekly-schedule-edit-modal"
                                                                        @click="
                                                                            form.schedule_id=@js($slot->id);
                                                                            form.day_of_week=@js($slot->day_of_week);
                                                                            form.start_time=@js(\Carbon\Carbon::parse($slot->start_time)->format('H:i'));
                                                                            form.end_time=@js(\Carbon\Carbon::parse($slot->end_time)->format('H:i'));
                                                                        ">
                                                                        <i class="bi bi-pencil me-2"></i>Edit
                                                                    </button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center small text-muted fst-italic py-2">No time slots yet</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center small text-muted fst-italic py-4">No weekly schedules found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Mobile / Small Screens --}}
    <div class="d-lg-none">
        @forelse($schedules as $dayOfWeek => $timeSlots)
            <div class="card shadow-sm rounded-3 mb-3">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="fw-semibold text-dark small">{{ $dayOfWeek }}</div>
                        <button class="btn btn-sm btn-success rounded-3 px-3"
                            data-bs-toggle="modal"
                            data-bs-target="#spa-weekly-schedule-create-modal"
                            @click="form.day_of_week='{{ $dayOfWeek }}'">
                            <i class="bi bi-plus-lg"></i> Add
                        </button>
                    </div>

                    @forelse($timeSlots as $slot)
                        <div class="d-flex justify-content-between align-items-center mb-2 small text-muted border-bottom py-1">
                            <div>
                                {{ \Carbon\Carbon::parse($slot->start_time)->format('g:i A') }} -
                                {{ \Carbon\Carbon::parse($slot->end_time)->format('g:i A') }}
                            </div>
                            <div class="dropdown position-relative">
                                <button class="btn btn-sm btn-light border rounded-3" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3">
                                    <li>
                                        <button class="dropdown-item"><i class="bi bi-eye me-2"></i>View</button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#spa-weekly-schedule-edit-modal"
                                            @click="
                                                form.schedule_id=@js($slot->id);
                                                form.day_of_week=@js($slot->day_of_week);
                                                form.start_time=@js(\Carbon\Carbon::parse($slot->start_time)->format('H:i'));
                                                form.end_time=@js(\Carbon\Carbon::parse($slot->end_time)->format('H:i'));
                                            ">
                                            <i class="bi bi-pencil me-2"></i>Edit
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @empty
                        <div class="small fst-italic text-muted py-2">No time slots yet</div>
                    @endforelse
                </div>
            </div>
        @empty
            <div class="text-center small text-muted fst-italic py-5">No weekly schedules found</div>
        @endforelse
    </div>

    {{-- Modals --}}
    @include('admin.spa-weekly-schedules.modals')

</div>


@endsection
