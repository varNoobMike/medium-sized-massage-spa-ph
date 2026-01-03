@extends('layouts.admin.app')

@section('title', 'Clients')

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

@section('page-heading', 'Clients')
@section('page-heading-small', 'Lorem ipsum dolor set amet.')

@section('content')


{{-- Alert Update Weekly Schedule Error --}}
@if($errors->any())
<div class="alert alert-danger rounded-3 mb-4">
    {{ $errors->first() }}
</div>
{{-- Alert Update Weekly Schedule Success --}}
@elseif(session('approve_client_success'))
<div class="alert alert-success rounded-3 mb-4">
    {{ session('approve_client_success') }}
</div>
@endif


{{-- Table --}}
<table class="table table-hover">

    <thead>
        <tr>
            <th class="p-3">Email</th>
            <th class="p-3">Name</th>
            <th class="p-3">Email Verified At</th>
            <th class="p-3">Action</th>
        </tr>
    </thead>

    <tbody>

        @forelse ( $clients as $client)
        <tr>
            <td class="p-3">{{ $client->email }}</td>
            <td class="p-3">{{ $client->name }}</td>
            <td class="p-3">{{ $client->email_verified_at ?? 'Unverified' }}</td>

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

                    </ul>

                </div>

            </td>

        </tr>

        @empty

        @endforelse

    </tbody>

</table>

@endsection