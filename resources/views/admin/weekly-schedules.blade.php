@extends('layouts.admin.app')

@section('title', 'Weekly Schedules')

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

@section('page-heading', 'Weekly Schedules')
@section('page-heading-small', 'Lorem ipsum dolor set amet.')


@section('content')
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
                            <td>{{ $schedule['day_of_week'] }}</td>
                            <td>{{ $schedule['open_time'] }}</td>
                            <td>{{ $schedule['close_time'] }}</td>
                            
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
                                            <button 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#spa-weekly-schedule-edit-modal"
                                                data-id="{{ $schedule['id'] }}"
                                                data-dow="{{ $schedule['day_of_week'] }}"
                                                data-ot="{{ $schedule['open_time'] }}"
                                                data-ct="{{ $schedule['close_time'] }}" 
                                                class="dropdown-item">
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
    
    <div id="spa-weekly-schedule-edit-modal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-semibold">Edit Schedule</h5>
                </div>
                <div class="modal-body">
                    <form method="dialog">
                        @csrf

                        <div class="mb-4">
                            <label for="" class="form-label">Day of Week</label>
                            <select name="day_of_week" id="" class="form-select">
                                <option value="" selected>-- Select Day of Week --</option>
                                <option value="Sunday">Sunday</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="" class="form-label">Open Time</label>
                            <input type="time" class="form-control" name="open_time">
                        </div>

                        <div class="mb-4">
                            <label for="" class="form-label">Close Time</label>
                            <input type="time" class="form-control" name="close_time">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Save</button>

                    </form>
                </div>
            </div>
        </div>
        
    </div>

@endsection

@section('foot-script-specific')
    <script src="{{ asset('assets/js/script_admin.js') }}"></script>
@endsection

