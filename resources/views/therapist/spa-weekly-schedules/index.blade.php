@extends('layouts.therapist.app')

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


{{-- Spa Weekly Schedules Table --}}
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="p-3">Day of Week</th>
                <th class="p-3">Start Time</th>
                <th class="p-3">Break Start</th>
                <th class="p-3">Break End</th>
                <th class="p-3">End Time</th>
            </tr>
        </thead>
        <tbody>

            @forelse ( $weeklySchedules as $schedule)
            <tr>
                <td class="p-3">{{ $schedule->day_of_week }}</td>
                <td class="p-3">{{ \Carbon\Carbon::parse($schedule->start_time)->format('g:i A') }}</td>
                <td class="p-3">
                    {{ $schedule->break_time_start
                            ? \Carbon\Carbon::parse($schedule->break_time_start)->format('g:i A')
                            : '—'
                        }}
                </td>

                <td class="p-3">
                    {{ $schedule->break_time_end
                            ? \Carbon\Carbon::parse($schedule->break_time_end)->format('g:i A')
                            : '—'
                        }}
                </td>
                <td class="p-3">{{ \Carbon\Carbon::parse($schedule->end_time)->format('g:i A') }}</td>
            </tr>
            @empty
            <tr>
                <td class="text-center" colspan="5">Schedules not found.</td>
            </tr>
            @endforelse

        </tbody>
    </table>
</div>

@endsection