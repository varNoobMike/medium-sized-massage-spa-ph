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


       
        @php
            $keys = ['start_time', 'end_time', 'spa_weekly_schedule_update_error'];
        @endphp

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="list-unstyled mb-0">
                    @foreach ($errors->messages() as $field => $messages)
                        @if (in_array($field, $keys))
                            @foreach ($messages as $message)
                                <li class="d-flex align-items-center text-danger mb-1">
                                    <i class="bi bi-x-circle me-2"></i>
                                    {{ $message }}
                                </li>
                            @endforeach
                        @endif
                    @endforeach
                </ul>
            </div>

        @elseif(session('spa_weekly_schedule_update_success'))
            <div class="alert alert-success text-success rounded-3 mb-4">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('spa_weekly_schedule_update_success') }}
            </div>

        @elseif(session('spa_weekly_schedule_create_success'))
            <div class="alert alert-success text-success rounded-3 mb-4">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('spa_weekly_schedule_create_success') }}
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

                    @forelse($schedules as $dayOfWeek => $timeSlots)

                        {{-- Day of Week Row --}}
                        <tr>

                            <td class="fw-semibold align-middle">{{ $dayOfWeek }}</td>
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
                                                    @click="form.day_of_week = '{{ $dayOfWeek }}'">
                                                    <i class="bi bi-plus-lg"></i> Add slot
                                                </button>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($timeSlots as $slot)

                                            <tr class="align-middle">
                                                <td class="text-nowrap">
                                                    {{ \Carbon\Carbon::parse($slot->start_time)->format('g:i A') }}
                                                </td>
                                                <td class="text-nowrap">
                                                    {{ \Carbon\Carbon::parse($slot->end_time)->format('g:i A') }}
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
                                                                                form.schedule_id = @js($slot->id);
                                                                                form.day_of_week = @js($slot->day_of_week);
                                                                                form.start_time = @js(\Carbon\Carbon::parse($slot->start_time)->format('H:i'));
                                                                                form.end_time = @js(\Carbon\Carbon::parse($slot->end_time)->format('H:i'));
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



        {{-- Create Schedule Modal --}}
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

        {{-- Edit Schedule Modal --}}
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
