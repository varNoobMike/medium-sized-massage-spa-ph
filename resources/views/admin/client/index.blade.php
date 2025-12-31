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

        {{-- Table --}}
        <table class="table table-hover">

            <thead>
                <tr>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Email Verified At</th>
                    <th>Date Registered At</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse ( $clients as $client)
                    <tr>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->email_verified_at ?? 'Unverified' }}</td>
                        <td>{{ $client->created_at }}</td>

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
                                  
                                    
                        
                                </ul>

                            </div>

                        </td>

                    </tr>
                    
                @empty
                    
                @endforelse

            </tbody>

        </table>

@endsection

