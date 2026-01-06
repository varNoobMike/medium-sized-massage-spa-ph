@extends('layouts.therapist.app')

@section('title', 'My Weekly Schedules')

@section('breadcrumb')
@foreach ( $breadcrumbs as $crumb)
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

@section('page-heading', 'My Weekly Schedules')
@section('page-heading-small', 'Lorem ipsum dolor set amet.')


@section('content')

<div
    x-data="{
            loading: false,
            form: {
                schedule_id: null,
                day_of_week: '',
                start_time: '',
                end_time: ''
            }
        }">


    {{-- Alert Update Weekly Schedule Error --}}
    @if($errors->any())
    <div class="alert alert-danger rounded-3 mb-4">
        {{ $errors->first() }}
    </div>
    {{-- Alert Update Weekly Schedule Success --}}
    @elseif(session('staff_weekly_schedule_update_success'))
    <div class="alert alert-success rounded-3 mb-4">
        {{ session('staff_weekly_schedule_update_success') }}
    </div>
    @endif



    {{-- Weekly Schedules Table --}}
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="p-3">Day of Week</th>
                    <th class="p-3">Start Time</th>
                    <th class="p-3">End Time</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse ( $weeklySchedules as $schedule)
                <tr>
                    <td class="p-3">{{ $schedule->day_of_week }}</td>
                    <td class="p-3">{{ \Carbon\Carbon::parse($schedule->start_time)->format('g:i A') }}</td>
                    <td class="p-3">{{ \Carbon\Carbon::parse($schedule->end_time)->format('g:i A') }}</td>

                    <td class="p-3">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-secondary rounded-3 px-3" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                                <li>
                                    <button href="#" class="dropdown-item">
                                        <i class="bi bi-eye me-2"></i>View
                                    </button>
                                </li>
                                <li>
                                    <button class="dropdown-item"
                                        data-bs-toggle="modal"
                                        data-bs-target="#therapist-weekly-schedule-edit-modal"
                                        @click="
                                                        form.schedule_id = @js($schedule->id);
                                                        form.day_of_week = @js($schedule->day_of_week);
                                                        form.start_time = @js(\Carbon\Carbon::parse($schedule->start_time)->format('H:i'));
                                                        form.end_time = @js(\Carbon\Carbon::parse($schedule->end_time)->format('H:i'));">
                                        <i class="bi bi-pencil me-2"></i>
                                        Edit
                                    </button>
                                </li>

                            </ul>
                        </div>
                    </td>
                </tr>

                @empty
                <tr>
                    <td class="text-center" colspan="5">Schedule not found.</td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- Edit Modal --}}
    <div id="therapist-weekly-schedule-edit-modal" class="modal fade" tabindex="-1" aria-hidden="true"
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
                    <form
                        :action="`{{ url('therapist/weekly-schedules') }}/${form.schedule_id}`"
                        method="POST"
                        @submit.prevent="
                            if (loading) return;
                            loading = true;
                            $el.submit();
                        ">

                        @csrf
                        @method('PUT')


                        {{-- Day of Week --}}
                        <div class="mb-4">
                            <label for="" class="form-label">Day of Week</label>
                            <input type="text" readonly class="form-control rounded-3" name="day_of_week" x-model="form.day_of_week">
                        </div>

                        {{-- Start Time --}}
                        <div class="mb-4">
                            <label for="" class="form-label">Start Time</label>
                            <input type="time" class="form-control rounded-3" name="start_time" x-model="form.start_time">
                        </div>

                        {{-- End Time --}}
                        <div class="mb-4">
                            <label for="" class="form-label">End Time</label>
                            <input type="time" class="form-control rounded-3" name="end_time" x-model="form.end_time">
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit" class="btn btn-primary w-100 rounded-3" :disabled="loading">
                            <span x-show="!loading">Save</span>

                            <span x-show="loading" class="spinner spinner-border spinner-border-sm ms-2"
                                role="status"
                                aria-hidden="true">
                            </span>
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection