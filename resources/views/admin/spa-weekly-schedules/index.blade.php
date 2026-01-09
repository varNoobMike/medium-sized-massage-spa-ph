@extends('layouts.admin.app')

@section('title', 'Spa Weekly Schedules')

@section('breadcrumb')
    @foreach ($breadcrumbs as $crumb)
        @if ($crumb['url'])
            <li class="breadcrumb-item">
                <a href="{{ $crumb['url'] }}" class="text-dark">{{ $crumb['title'] }}</a>
            </li>
        @else
            <li class="breadcrumb-item">
                {{ $crumb['title'] }}
            </li>
        @endif
    @endforeach
@endsection

@section('page-heading', 'Spa Weekly Schedules')
@section('page-heading-small', 'Lorem ipsum dolor set amet.')

@section('content')

    <div x-data="{
        loading: false,
        form: {
            schedule_id: null,
            day_of_week: '',
            start_time: '',
            end_time: ''
        }
    }">


        @if ($errors->any())
            <div class="alert alert-danger rounded-3 mb-4">
                {{ $errors->first() }}
            </div>
        @elseif(session('spa_weekly_schedule_update_success'))
            <div class="alert alert-success rounded-3 mb-4">
                {{ session('spa_weekly_schedule_update_success') }}
            </div>
        @endif



        {{-- Spa Weekly Schedules Table --}}
        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 200px;">Day of Week</th>
                        <th>Time Slots</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($weeklySchedules as $dayOfWeekStr => $schedulesArr)

                        {{-- Day of Week Row --}}
                        <tr
                            class="{{ session('updatedSchedule') && session('updatedSchedule')->day_of_week === $dayOfWeekStr
                                ? 'table-success'
                                : '' }}">

                            <td class="fw-semibold align-middle">{{ $dayOfWeekStr }}</td>
                            <td class="p-0">
                                {{-- Nested Time Slots Table --}}
                                <table class="table table-sm mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 120px;">Start</th>
                                            <th style="width: 120px;">End</th>
                                            <th class="text-end">
                                                <button class="btn btn-sm btn-success rounded-3 px-3" data-bs-toggle="modal"
                                                    data-bs-target="#spa-weekly-schedule-create-modal"
                                                    @click="form.day_of_week = '{{ $dayOfWeekStr }}'">
                                                    <i class="bi bi-plus-lg"></i> Add slot
                                                </button>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($schedulesArr as $schedule)
                                            <tr class="align-middle  
                                                {{ session('updatedSchedule') && session('updatedSchedule')->id === $schedule->id
                                                    ? 'table-success'
                                                    : '' }}">
                                                <td class="text-nowrap">
                                                    {{ \Carbon\Carbon::parse($schedule->start_time)->format('g:i A') }}
                                                </td>
                                                <td class="text-nowrap">
                                                    {{ \Carbon\Carbon::parse($schedule->end_time)->format('g:i A') }}
                                                </td>
                                                <td class="text-end">
                                                    {{-- Actions Dropdown --}}
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-outline-secondary"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bi bi-three-dots"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li>
                                                                <button class="dropdown-item">
                                                                    <i class="bi bi-eye me-2"></i>View
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#spa-weekly-schedule-edit-modal"
                                                                    @click="
                                                                                form.schedule_id = @js($schedule->id);
                                                                                form.day_of_week = @js($schedule->day_of_week);
                                                                                form.start_time = @js(\Carbon\Carbon::parse($schedule->start_time)->format('H:i'));
                                                                                form.end_time = @js(\Carbon\Carbon::parse($schedule->end_time)->format('H:i'));
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
                                                <td colspan="3" class="text-center fst-italic text-muted py-2">
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
                            <td colspan="2" class="text-center text-muted py-4 fst-italic">
                                No weekly schedules found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>



        {{-- Create Time Slot Modal --}}
        <div id="spa-weekly-schedule-create-modal" class="modal fade" tabindex="-1" aria-hidden="true"
            @hidden.bs.modal="
                    form.schedule_id = null;
                    form.day_of_week = '';
                    form.start_time = '';
                    form.end_time = '';">

            <div class="modal-dialog">
                <div class="modal-content rounded-3">
                    <div class="modal-header">
                        <h5 class="modal-title fw-semibold">Create Time Slot</h5>
                    </div>
                    <div class="modal-body">

                        {{-- Form --}}
                        <form :action="`{{ url('admin/spa-weekly-schedules') }}`" method="POST"
                            @submit.prevent="
                                    if (loading) return;
                                    loading = true;
                                    $el.submit(); ">

                            @csrf

                            {{-- Day of Week --}}
                            <div class="mb-4">
                                <label for="" class="form-label">Day of Week</label>
                                <input type="text" readonly class="form-control rounded-3" name="day_of_week"
                                    x-model="form.day_of_week">
                            </div>

                            {{-- Start Time --}}
                            <div class="mb-4">
                                <label for="" class="form-label">Start Time</label>
                                <input type="time" class="form-control rounded-3" name="start_time">
                            </div>

                            {{-- End Time --}}
                            <div class="mb-4">
                                <label for="" class="form-label">End Time</label>
                                <input type="time" class="form-control rounded-3" name="end_time">
                            </div>

                            {{-- Submit Button --}}
                            <button type="submit" class="btn btn-primary w-100 rounded-3" :disabled="loading">
                                <span x-show="!loading">Save</span>

                                <span x-show="loading" class="spinner spinner-border spinner-border-sm ms-2" role="status"
                                    aria-hidden="true">
                                </span>
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
                    form.end_time = '';">

            <div class="modal-dialog">
                <div class="modal-content rounded-3">
                    <div class="modal-header">
                        <h5 class="modal-title fw-semibold">Edit Schedule</h5>
                    </div>
                    <div class="modal-body">

                        {{-- Form --}}
                        <form :action="`{{ url('admin/spa-weekly-schedules') }}/${form.schedule_id}`" method="POST"
                            @submit.prevent="
                                    if (loading) return;
                                    loading = true;
                                    $el.submit(); ">

                            @csrf
                            @method('PUT')


                            {{-- Day of Week --}}
                            <div class="mb-4">
                                <label for="" class="form-label">Day of Week</label>
                                <input type="text" readonly class="form-control rounded-3" name="day_of_week"
                                    x-model="form.day_of_week">
                            </div>

                            {{-- Start Time --}}
                            <div class="mb-4">
                                <label for="" class="form-label">Start Time</label>
                                <input type="time" class="form-control rounded-3" name="start_time"
                                    x-model="form.start_time">
                            </div>

                            {{-- End Time --}}
                            <div class="mb-4">
                                <label for="" class="form-label">End Time</label>
                                <input type="time" class="form-control rounded-3" name="end_time"
                                    x-model="form.end_time">
                            </div>

                            {{-- Submit Button --}}
                            <button type="submit" class="btn btn-primary w-100 rounded-3" :disabled="loading">
                                <span x-show="!loading">Save</span>

                                <span x-show="loading" class="spinner spinner-border spinner-border-sm ms-2"
                                    role="status" aria-hidden="true">
                                </span>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
