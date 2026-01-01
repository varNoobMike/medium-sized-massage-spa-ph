@extends('layouts.admin.app')

@section('title', 'Therapists')

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

@section('page-heading', 'Therapists')
@section('page-heading-small', 'Lorem ipsum dolor set amet.')


@section('content')
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
                @forelse ( $therapists as $therapist)
                    <tr>
                        <td>{{ $therapist->email }}</td>
                        <td>{{ $therapist->name }}</td>
                        <td>{{ $therapist->email_verified_at ?? 'Unverified' }}</td>
                        <td>{{ $therapist->created_at }}</td>
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
                                        <hr class="dropdown-divider"/>
                                    </li>

                                    <li>
                                        <a href="" class="dropdown-item text-danger">
                                            <i class="bi bi-ban me-2"></i>Block
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

