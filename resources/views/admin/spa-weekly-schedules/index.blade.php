@extends('layouts.panel.app')

@section('title', 'Manage Spa Weekly Schedules')

@section('page-heading', 'Spa Weekly Schedules')
@section('page-heading-small', "Manage spa's weekly schedule slots here.")

@section('content')
<div x-data="{
    loading: false,
    form: { schedule_id: null, day_of_week: '', start_time: '', end_time: '' }
}">

{{-- Alerts --}}
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-3 small d-flex align-items-center gap-2" role="alert">
        <i class="bi bi-exclamation-circle-fill opacity-75"></i>
        <div>{{ $errors->first() }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif(session('spa_weekly_schedule_action_success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3 mb-3 small d-flex align-items-center gap-2" role="alert">
        <i class="bi bi-check-circle-fill opacity-75"></i>
        <div>{{ session('spa_weekly_schedule_action_success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


{{-- Table (Desktop) --}}
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
                <tr class="align-middle hover-bg-light">
                    {{-- Day Column --}}
                    <td class="ps-3 fw-medium text-dark py-2">{{ $dayOfWeek }}</td>

                    {{-- Nested Table Column --}}
                    <td class="p-0">
                        <table class="table table-sm table-borderless mb-0">
                            <thead class="small text-muted">
                                <tr>
                                    <th class="ps-3">Start</th>
                                    <th>End</th>
                                    <th class="text-end pe-3">
                                        {{-- Add Button --}}
                                        <button
                                            class="btn btn-sm btn-primary rounded-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#spa-weekly-schedule-create-modal"
                                            @click="form.day_of_week='{{ $dayOfWeek }}'"
                                        >
                                            <i class="bi bi-plus-lg"></i> Add
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($timeSlots as $slot)
                                    <tr class="border-top hover-bg-light">
                                        <td class="ps-3">{{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }}</td>
                                        <td class="text-end pe-3">
                                            {{-- Edit Button --}}
                                            <button
                                                class="btn btn-sm btn-light border rounded-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#spa-weekly-schedule-edit-modal"
                                                @click="
                                                    form.schedule_id=@js($slot->id);
                                                    form.day_of_week=@js($slot->day_of_week);
                                                    form.start_time=@js(\Carbon\Carbon::parse($slot->start_time)->format('H:i'));
                                                    form.end_time=@js(\Carbon\Carbon::parse($slot->end_time)->format('H:i'));
                                                "
                                            >
                                                <i class="bi bi-pencil"></i> Edit
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted fst-italic py-3">
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
                    <td colspan="2" class="text-center text-muted fst-italic py-4">
                        No weekly schedules found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


{{-- Mobile Cards --}}
<div class="d-lg-none">
    @forelse($schedules as $dayOfWeek => $timeSlots)
        <div class="card border rounded-3 mb-3 shadow-sm hover-shadow">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="fw-semibold">{{ $dayOfWeek }}</div>
                    <button
                        class="btn btn-sm btn-primary rounded-3"
                        data-bs-toggle="modal"
                        data-bs-target="#spa-weekly-schedule-create-modal"
                        @click="form.day_of_week='{{ $dayOfWeek }}'">
                        <i class="bi bi-plus-lg"></i> Add
                    </button>
                </div>

                @forelse($timeSlots as $slot)
                    <div class="d-flex justify-content-between align-items-center py-2 border-top">
                        <div class="text-dark">
                            {{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }} – {{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }}
                        </div>
                        <button
                            class="btn btn-sm btn-light border rounded-3"
                            data-bs-toggle="modal"
                            data-bs-target="#spa-weekly-schedule-edit-modal"
                            @click="
                                form.schedule_id=@js($slot->id);
                                form.day_of_week=@js($slot->day_of_week);
                                form.start_time=@js(\Carbon\Carbon::parse($slot->start_time)->format('H:i'));
                                form.end_time=@js(\Carbon\Carbon::parse($slot->end_time)->format('H:i'));
                            ">
                            <i class="bi bi-pencil"></i> Edit
                        </button>
                    </div>
                @empty
                    <div class="text-muted fst-italic py-2">No time slots yet</div>
                @endforelse
            </div>
        </div>
    @empty
        <div class="text-center text-muted fst-italic py-5">No weekly schedules found</div>
    @endforelse
</div>


{{-- Modals --}}

{{-- Create Time Slot Modal --}}
<div id="spa-weekly-schedule-create-modal" class="modal fade" tabindex="-1" aria-hidden="true"
    @hidden.bs.modal="
        form.schedule_id = null;
        form.day_of_week = '';
        form.start_time = '';
        form.end_time = '';
    ">
    <div class="modal-dialog">
        <div class="modal-content rounded-3">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-semibold">
                    <i class="bi bi-plus-lg me-2"></i>Create Time Slot
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

                <form :action="`{{ url('admin/spa-weekly-schedules') }}`" method="POST"
                    @submit.prevent="
                        if (loading) return;
                        loading = true;
                        $el.submit();
                    ">
                    @csrf

                    {{-- Day of Week --}}
                    <div class="mb-3">
                        <label class="form-label small">Day of Week</label>
                        <input type="text" @readonly(true) class="form-control rounded-3 small" x-model="form.day_of_week" name="day_of_week">
                    </div>

                    {{-- Start Time --}}
                    <div class="mb-3">
                        <label class="form-label small">Start Time</label>
                        <input type="time" class="form-control rounded-3 small" name="start_time" x-model="form.start_time">
                    </div>

                    {{-- End Time --}}
                    <div class="mb-3">
                        <label class="form-label small">End Time</label>
                        <input type="time" class="form-control rounded-3 small" name="end_time" x-model="form.end_time">
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-primary w-100 rounded-3" :disabled="loading">
                        <span x-show="!loading">Save</span>
                        <span x-show="loading" class="spinner-border spinner-border-sm ms-2"></span>
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

{{-- Edit Time Slot Modal --}}
<div id="spa-weekly-schedule-edit-modal" class="modal fade" tabindex="-1" aria-hidden="true"
    @hidden.bs.modal="
        form.schedule_id = null;
        form.day_of_week = '';
        form.start_time = '';
        form.end_time = '';
    ">
    <div class="modal-dialog">
        <div class="modal-content rounded-3">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-semibold">
                    <i class="bi bi-pencil me-2"></i>Edit Time Slot
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

                <form :action="`{{ url('admin/spa-weekly-schedules') }}/${form.schedule_id}`" method="POST"
                    @submit.prevent="
                        if (loading) return;
                        loading = true;
                        $el.submit();
                    ">
                    @csrf
                    @method('PUT')

                    {{-- Day of Week --}}
                    <div class="mb-3">
                        <label class="form-label small">Day of Week</label>
                        <input type="text" readonly class="form-control rounded-3 small" x-model="form.day_of_week" name="day_of_week">
                    </div>

                    {{-- Start Time --}}
                    <div class="mb-3">
                        <label class="form-label small">Start Time</label>
                        <input type="time" class="form-control rounded-3 small" x-model="form.start_time" name="start_time">
                    </div>

                    {{-- End Time --}}
                    <div class="mb-3">
                        <label class="form-label small">End Time</label>
                        <input type="time" class="form-control rounded-3 small" x-model="form.end_time" name="end_time">
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-primary w-100 rounded-3" :disabled="loading">
                        <span x-show="!loading">Save</span>
                        <span x-show="loading" class="spinner-border spinner-border-sm ms-2"></span>
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

</div>
@endsection
