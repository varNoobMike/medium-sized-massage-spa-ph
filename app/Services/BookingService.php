<?php

namespace App\Services;

use App\Exceptions\Booking\CreateFailedException;
use Illuminate\Support\Collection;
use App\Models\Booking;


class BookingService
{
    /**
     * Create Booking
     * 
     */
    public function createBooking(array $createBookingData): Booking|null
    {
        $booking = Booking::create([
           //
        ]);


        if (!$booking) {
            throw new CreateFailedException("Failed to create booking. Please retry!");
        }

        return $booking;
    }

  
}
