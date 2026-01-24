<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\BookingService;
use App\Services\ServicesService;
use App\Services\TherapistService;


class BookingAvailabilityController extends Controller
{
    public function __construct(
        private BookingService $bookingService,
        private ServicesService $servicesService, 
        private TherapistService $therapistService
    ){}


    public function index(Request $request)
    {
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('client.home.index')],
            ['title' => 'Bookings', 'url' => route('client.bookings.index')],
            ['title' => 'Search Availability', 'url' => null],
        ];

        $services   = $this->servicesService->getServices();
        $therapists = $this->therapistService->getTherapists();

        $slots  = collect();

        // use manual validation for GET method instead of creating Request at FormRequest
        if ($request->has('search')) 
        {
            $validator = Validator::make($request->all(), [
                'booking_date'  => 'required|date|after_or_equal:today',
                'service_id'   => 'required|integer|exists:services,id',
                'therapist_id' => 'required|integer|exists:users,id',
            ]);

            if ($validator->fails()) {
                return view('client.bookings.availabilities.index', compact(
                            'breadcrumbs', 'services', 'therapists', 
                ))->withErrors($validator);
            }


            $slots = $this->bookingService->getAvailableSlots($request->all());

            session([
                'available_slots' => $slots,
                'booking_date'     => $request->booking_date,
                'service_id'      => $request->service_id,
                'therapist_id'    => $request->therapist_id,
            ]);


            return view('client.bookings.availabilities.index', compact(
                'breadcrumbs', 'services', 'therapists', 'slots',
            ));
        }

        return view('client.bookings.availabilities.index', compact(
            'breadcrumbs', 'services', 'therapists', 
        ));
        
    }

    
}
