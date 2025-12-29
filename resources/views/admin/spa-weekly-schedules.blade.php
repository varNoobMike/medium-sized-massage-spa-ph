@extends('layouts.admin.app')

@section('title', 'Spa Weekly Schedules')

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

@section('page-heading', 'Spa Weekly Schedules')
@section('page-heading-small', 'Lorem ipsum dolor set amet.')


@section('content')

    <div 
        x-data="{
            loading: false,
            form: {
                spa_id: null,
                day_of_week: '',
                open_time: '',
                close_time: ''
            }
        }"
        >

        {{-- Form Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                {{ $errors->first() }}
            </div>
        {{-- Runtime / DB error --}}
        @elseif (session('error'))
            <div class="alert alert-danger mb-4">
                {{ session('error') }}
            </div>
        {{-- Success Message --}}
        @elseif (session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        
        {{-- Weekly Schedules Table --}} 
        <div class="table-responsive">
            <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Day of Week</th>
                            <th>Open Time</th>
                            <th>Close Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $weeklySchedules as $schedule)
                            <tr>
                                <td>{{ $schedule->day_of_week }}</td>
                                <td>{{ \Carbon\Carbon::parse($schedule->open_time)->format('g:i A') }}</td>
                                <td>{{ \Carbon\Carbon::parse($schedule->close_time)->format('g:i A') }}</td>
                                
                                <td>
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
                                                    data-bs-target="#spa-weekly-schedule-edit-modal"
                                                    @click="
                                                        form.spa_id = {{ $schedule->spa_id }};
                                                        form.day_of_week = @js($schedule->day_of_week);
                                                        form.open_time = @js(\Carbon\Carbon::parse($schedule->open_time)->format('H:i'));
                                                        form.close_time = @js(\Carbon\Carbon::parse($schedule->close_time)->format('H:i'));"
                                                >
                                                    <i class="bi bi-pencil me-2"></i>
                                                    Edit
                                                </button>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider"/>
                                            </li>
                                            <li>
                                                <button class="dropdown-item text-danger">
                                                    <i class="bi bi-trash me-2"></i>Delete
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            
                        @empty
                            
                        @endforelse
                    </tbody>
            </table>
        </div>
        
        {{-- Edit Modal) --}}
        <div id="spa-weekly-schedule-edit-modal" class="modal fade" tabindex="-1" aria-hidden="true"
            @hidden.bs.modal="
            form.spa_id = null;
            form.day_of_week = '';
            form.open_time = '';
            form.close_time = '';">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-semibold">Edit Schedule</h5>
                    </div>
                    <div class="modal-body">

                        {{-- Form --}}
                        <form action="{{ route('admin.spa-weekly-schedules.update', $schedule->spa_id) }}" method="POST"
                            @submit.prevent="
                            if (loading) return;
                            loading = true;
                            $el.submit();
                        ">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="spa_id" x-model="form.spa_id">

                            <div class="mb-4">
                                <label for="" class="form-label">Day of Week</label>
                                <input type="text" @readonly(true) class="form-control" name="day_of_week" x-model="form.day_of_week">
                            </div>

                            <div class="mb-4">
                                <label for="" class="form-label">Open Time</label>
                                <input type="time" class="form-control" name="open_time" x-model="form.open_time">
                            </div>

                            <div class="mb-4">
                                <label for="" class="form-label">Close Time</label>
                                <input type="time" class="form-control" name="close_time" x-model="form.close_time">
                            </div>

                            <button type="submit" class="btn btn-primary w-100" :disabled="loading">
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





