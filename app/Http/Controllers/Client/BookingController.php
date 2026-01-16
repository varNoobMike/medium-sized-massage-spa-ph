<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\ServicesService;
use App\Services\TherapistService;
use App\Http\Requests\Booking\StoreBookingRequest;

class BookingController extends Controller
{

    public function __construct(private ServicesService $servicesService, private TherapistService $therapistService) {}

    public function index()
    {
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('client.home.index')],
            ['title' => 'Bookings', 'url' => null],
        ];

        return view('client.bookings.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('client.home.index')],
            ['title' => 'Bookings', 'url' => route('client.bookings.index')],
            ['title' => 'Book Session', 'url' => null],
        ];

        $services = $this->servicesService->getServices();
        $therapists = $this->therapistService->getTherapists();

        return view('client.bookings.create', compact('breadcrumbs', 'services', 'therapists'));
    }

    public function store(StoreBookingRequest $request)
    {
        $createBookingData = $request->validated();
    }
}
