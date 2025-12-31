@extends('layouts.admin.app')

@section('title', 'Spa Profile')

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

@section('page-heading', 'Spa Profile')
@section('page-heading-small', 'Lorem ipsum dolor set amet.')

@section('content')

        {{-- Table --}}
        <table class="table table-hover">

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Logo</th>
                    <th>Location</th>
                    <th>Total Beds</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse ( $spaProfile as $profile)
                    <tr>
                        <td>{{ $profile->name }}</td>
                        <td>{{ $profile->company->email }}</td>
                        <td>{{ $profile->company->phone }}</td>
                        <td>{{ $profile->company->logo ?? 'No Image' }}</td>
                        <td>{{ $profile->location }}</td>
                        <td>{{ $profile->total_beds }}</td>

                        {{-- Dropdown Action --}}
                        <td>

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

                                   

                                </ul>

                            </div>

                        </td>

                    </tr>
                    
                @empty
                    
                @endforelse

            </tbody>

        </table>

@endsection

