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
                    <th class="p-3">Name</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Phone</th>
                    <th class="p-3">Logo</th>
                    <th class="p-3">Location</th>
                    <th class="p-3">Total Beds</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>

            <tbody>

              
                @if($spaProfile)

                    @php
                        $profile = $spaProfile;
                    @endphp
                    
                    <tr>
                        <td class="p-3">{{ $profile->company->name }}</td>
                        <td class="p-3">{{ $profile->company->email }}</td>
                        <td class="p-3">{{ $profile->company->phone }}</td>
                        <td class="p-3">{{ $profile->company->logo ?? 'No Image' }}</td>
                        <td class="p-3">{{ $profile->location }}</td>
                        <td class="p-3">{{ $profile->total_beds }}</td>

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

                                   

                                </ul>

                            </div>

                        </td>

                    </tr>
                
                    
                @endif

            </tbody>

        </table>

@endsection

