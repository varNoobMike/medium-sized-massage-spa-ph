@extends('layouts.therapist.app')

@section('title', 'Spa Services')

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

@section('page-heading', 'Spa Services')
@section('page-heading-small', 'Lorem ipsum dolor set amet.')

@section('content')




{{-- Table --}}
<table class="table table-hover">

    <thead>
        <tr>
            <th class="p-3">Name</th>
            <th class="p-3">Duration (mins)</th>
            <th class="p-3">Price</th>
        </tr>
    </thead>

    <tbody>

        @forelse ( $services as $service)
        <tr>
            <td class="p-3">{{ $service->name }}</td>
            <td class="p-3">{{ $service->duration_minutes }}</td>
            <td class="p-3">{{ $service->price }}</td>
        </tr>

        @empty
        <tr>
            <td class="text-center" colspan="3">
                No Services found.
            </td>
        </tr>
        @endforelse

    </tbody>

</table>

@endsection