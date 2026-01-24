<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BookingService;


class BookingController extends Controller
{

    /**
     * Constructor
     * 
     */
    public function __construct(private BookingService $service) {}

    /**
     * Display clients
     * 
     */
    public function index()
    {
        $breadcrumbs = [
            ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
            ['title' => 'Spa Settings', 'url' => null],
        ];

        $bookings = $this->service->getBookings();

        // dd($bookings->toArray());

        return view('admin.bookings.index', compact('breadcrumbs', 'bookings'));
    }
}
