@extends('layouts.panel.app')

@section('title', 'Manage Bookings')

@section('page-heading', 'Bookings')
@section('page-heading-small', 'Manage all bookings here.')

@section('content')

{{-- Alerts --}}
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-3 small d-flex align-items-center gap-2" role="alert">
        <i class="bi bi-exclamation-circle-fill opacity-75"></i>
        <div>{{ $errors->first() }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif(session('booking_action_success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3 mb-3 small d-flex align-items-center gap-2" role="alert">
        <i class="bi bi-check-circle-fill opacity-75"></i>
        <div>{{ session('booking_action_success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Table (Desktop) --}}
<div class="table-responsive mb-4 d-none d-lg-block">
    <table class="table table-hover align-middle mb-0 small">
        <thead class="table-light text-uppercase text-secondary fw-semibold">
            <tr>
                <th class="ps-3 py-2">Client Email</th>
                <th class="py-2">Date</th>
                <th class="py-2">Start Time</th>
                <th class="py-2">End Time</th>
                <th class="py-2">Total Amount</th>
                <th class="py-2">Status</th>
                <th class="py-2 text-end pe-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bookings as $booking)
                <tr class="hover-bg-light">
                    <td class="ps-3 fw-medium text-dark py-2">{{ $booking->client->email }}</td>
                    <td class="text-muted py-2">{{ $booking->booking_date }}</td>
                    <td class="text-muted py-2">{{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }}</td>
                    <td class="text-muted py-2">{{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}</td>
                    <td class="text-muted py-2">${{ number_format($booking->total_amount, 2) }}</td>
                    <td class="py-2">
                        @if($booking->status === 'confirmed')
                            <span class="badge bg-success text-white fw-semibold py-1 px-2 small">Confirmed</span>
                        @elseif($booking->status === 'pending')
                            <span class="badge bg-warning-subtle text-dark fw-semibold py-1 px-2 small">Pending</span>
                        @elseif($booking->status === 'cancelled')
                            <span class="badge bg-danger text-white fw-semibold py-1 px-2 small">Cancelled</span>
                        @endif
                    </td>
                    <td class="text-end pe-3 py-2">
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm p-1 border rounded-3" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots fs-6"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end rounded-3 shadow-sm">
                                <li>
                                    <a class="dropdown-item small d-flex align-items-center gap-2 py-1" href="#">
                                        <i class="bi bi-eye fs-6"></i> View
                                    </a>
                                </li>
                                @if($booking->status === 'pending')
                                    <li>
                                        <form method="POST" action="#">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="dropdown-item small text-success d-flex align-items-center gap-2 py-1" onclick="return confirm('Confirm this booking?');">
                                                <i class="bi bi-check-circle fs-6"></i> Confirm
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                        <form method="POST" action="#">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="dropdown-item small text-danger d-flex align-items-center gap-2 py-1" onclick="return confirm('Cancel this booking?');">
                                                <i class="bi bi-x-circle fs-6"></i> Cancel
                                            </button>
                                        </form>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4 small">
                        <i class="bi bi-calendar-check fs-4 d-block mb-2"></i>
                        No bookings found
                        <div class="mt-1">Bookings will appear here once clients make reservations.</div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Mobile Cards --}}
<div class="d-lg-none">
    @forelse ($bookings as $booking)
        <div class="card border rounded-3 mb-3 shadow-sm hover-shadow">
            <div class="card-body p-3 d-flex justify-content-between align-items-start">
                <div class="flex-grow-1 me-3">
                    <div class="fw-semibold text-dark">{{ $booking->client->email }}</div>
                    <div class="small text-muted">{{ $booking->booking_date }}</div>
                    <div class="small text-muted">
                        {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - 
                        {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}
                    </div>
                    <div class="mt-1">
                        @if($booking->status === 'confirmed')
                            <span class="badge bg-success text-white fw-semibold py-1 px-2 small">Confirmed</span>
                        @elseif($booking->status === 'pending')
                            <span class="badge bg-warning-subtle text-dark fw-semibold py-1 px-2 small">Pending</span>
                        @elseif($booking->status === 'cancelled')
                            <span class="badge bg-danger text-white fw-semibold py-1 px-2 small">Cancelled</span>
                        @endif
                    </div>
                </div>
                <div class="dropdown flex-shrink-0">
                    <button class="btn btn-light btn-sm p-1 border rounded-3" data-bs-toggle="dropdown" aria-label="Booking actions">
                        <i class="bi bi-three-dots fs-5"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end rounded-3 shadow-sm">
                        <li>
                            <a class="dropdown-item small d-flex align-items-center gap-2 py-1" href="#">
                                <i class="bi bi-eye fs-6"></i> View
                            </a>
                        </li>
                        @if($booking->status === 'pending')
                            <li>
                                <form method="POST" action="#">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="dropdown-item small text-success d-flex align-items-center gap-2 py-1" onclick="return confirm('Confirm this booking?');">
                                        <i class="bi bi-check-circle fs-6"></i> Confirm
                                    </button>
                                </form>
                            </li>
                            <li>
                                <form method="POST" action="#">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="dropdown-item small text-danger d-flex align-items-center gap-2 py-1" onclick="return confirm('Cancel this booking?');">
                                        <i class="bi bi-x-circle fs-6"></i> Cancel
                                    </button>
                                </form>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center text-muted py-5 small">
            <i class="bi bi-calendar-check fs-4 d-block mb-2"></i>
            No bookings found
            <div class="mt-1">Bookings will appear here once clients make reservations.</div>
        </div>
    @endforelse
</div>

@endsection
