<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\ServicesService;
use App\Services\TherapistService;
use App\Http\Requests\Booking\StoreBookingRequest;
use App\Services\BookingService;


class BookingController extends Controller
{

    public function __construct(
        private BookingService $bookingService,
        private ServicesService $servicesService, 
        private TherapistService $therapistService) {}

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
        
    }

    public function store(StoreBookingRequest $request)
    {
        $this->bookingService->createBooking($request->validated());
    }

    public function checkAvaialableSlots(){
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('client.home.index')],
            ['title' => 'Bookings', 'url' => route('client.bookings.index')],
            ['title' => 'Book Session', 'url' => null],
        ];

        $services = $this->servicesService->getServices();
        $therapists = $this->therapistService->getTherapists();

        return view('client.bookings.check-available-slots', compact('breadcrumbs', 'services', 'therapists'));
    }
}
