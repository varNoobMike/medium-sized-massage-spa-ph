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

        return DB::transaction(function () use ($createBookingData, $bookingItemsData) {

            $booking = Booking::create($createBookingData);

            if (! $booking) {
                throw new CreateFailedException(
                    'Failed to create booking. Please retry.'
                );
            }


             /*
             'booking_id',
                'service_id',
                'therapist_id',
                'duration_minutes',
                'price',
                'notes'
            */

            $items = collect($bookingItemsData)->map(fn ($item) => [
                ...$item,
                'booking_id' => $booking->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $bookingItems = BookingItem::insert($items->toArray());

            if(!$bookingItems) {
                throw new CreateFailedException(
                    'Failed to create booking. Please retry.'
                );
            }

            return $booking->load('items');
        });


        
    }

  
}
