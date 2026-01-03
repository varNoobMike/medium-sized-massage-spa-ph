@extends('layouts.admin.app')

@section('title', 'Services')

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

@section('page-heading', 'Services')
@section('page-heading-small', 'Lorem ipsum dolor set amet.')

@section('content')


{{-- Alert Update Service Error --}}
@if($errors->any())
<div class="alert alert-danger rounded-3 mb-4">
    {{ $errors->first() }}
</div>
{{-- Alert Update Service Success --}}
@elseif(session('approve_client_success'))
<div class="alert alert-success rounded-3 mb-4">
    {{ session('update_service_success') }}
</div>
@endif


{{-- Table --}}
<table class="table table-hover">

    <thead>
        <tr>
            <th class="p-3">Name</th>
            <th class="p-3">Duration (mins)</th>
            <th class="p-3">Price</th>
            <th class="p-3">Action</th>
        </tr>
    </thead>

    <tbody>

        @forelse ( $services as $service)
        <tr>
            <td class="p-3">{{ $service->name }}</td>
            <td class="p-3">{{ $service->duration_minutes }}</td>
            <td class="p-3">{{ $service->price }}</td>

            {{-- Dropdown Action --}}
            <td class="p-3">

                <div class="dropdown">

                    <button class="btn btn-sm btn-secondary rounded-3 px-3" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">

                        <li>
                            <a href="" class="dropdown-item">
                                <i class="bi bi-eye me-2"></i>View
                            </a>
                        </li>

                        <li>
                            <a href="" class="dropdown-item">
                                <i class="bi bi-pencil me-2"></i>Edit
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a href="" class="dropdown-item text-danger">
                                <i class="bi bi-trash me-2"></i>Delete
                            </a>
                        </li>

                    </ul>

                </div>

            </td>

        </tr>

        @empty

        @endforelse

    </tbody>

</table>

@endsection