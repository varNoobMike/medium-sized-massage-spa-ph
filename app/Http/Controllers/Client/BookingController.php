<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\Booking\StoreBookingRequest;
use Illuminate\Support\Facades\Validator;
use App\Services\BookingService;
use App\Services\ServicesService;
use App\Services\TherapistService;


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

    public function create(Request $request)
    {
        $slots = session('available_slots', []); 
        $slotIndex = $request->slot_index;

        if(!isset($slots[$slotIndex])) {
            return back();
        }

        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('client.home.index')],
            ['title' => 'Bookings', 'url' => route('client.bookings.index')],
            ['title' => 'Book', 'url' => null],
        ];

        $services   = $this->servicesService->getServices();
        $therapists = $this->therapistService->getTherapists();

        $selectedSlot = $slots[$slotIndex];

        $selected = collect([
            'booking_date' => session('booking_date'),
            'therapist_id' => session('therapist_id'),
            'start_time' => Carbon::parse($selectedSlot->start_time)->format('H:i'),
            'end_time' => Carbon::parse($selectedSlot->end_time)->format('H:i'),
            'service_id' => session('service_id'),
        ]);

        return view('client.bookings.create', compact('breadcrumbs', 'services', 'therapists', 'selected'));
    }

    public function store(StoreBookingRequest $request)
    {
        $this->bookingService->createBooking($request->validated());

        return redirect()
            ->route('client.bookings.index')
            ->with(
                'booking_action_success',
                "You have been booked successfully."
            );
    }
    


}
