@extends('layouts.panel.app')

@section('title', 'Therapist Dashboard')

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

@section('page-heading', 'Therapist')
@section('page-heading-small', 'Lorem ipsum dolor set amet.')


@section('content')

@endsection

