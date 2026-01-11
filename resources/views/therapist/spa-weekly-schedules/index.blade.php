@extends('layouts.therapist.app')

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



@endsection
