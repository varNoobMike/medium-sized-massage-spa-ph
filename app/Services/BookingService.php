<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Exceptions\Booking\BookingCreateFailedException;
use App\Services\AuthService;
use App\Services\ServicesService;
use App\Services\SpaService;
use App\Services\SpaSettingService;
use App\Services\SpaWeeklyScheduleService;


class BookingService
{
    public function __construct(
        private AuthService $authService, 
        private ServicesService $servicesService,
        private SpaService $spaService,
        private SpaSettingService $spaSettingService,
        private SpaWeeklyScheduleService $scheduleService
    ){}


    /**
     * Create Booking
     * 
     */
    public function createBooking(array $createBookingData): Booking|null
    {

        $bookingSpecificData = [
            'client_id' => auth()->user()->id,
            'spa_id' => $this->spaService->getSpa()->id,
            'booking_date' => $createBookingData['booking_date'],
            'start_time' =>  $createBookingData['start_time'],
            'end_time' => $createBookingData['end_time'],
            'total_amount' => $this->servicesService
                        ->getServiceById($createBookingData['service_id'])
                        ->price * 1,
            'status' => Booking::STATUS_CONFIRMED,
        ];

        $bookingItemSpecificData = [
            [
                'service_id' =>  $createBookingData['service_id'],
                'duration_minutes' => $this->servicesService
                                ->getServiceById($createBookingData['service_id'])
                                ->duration_minutes,
                'price' => $this->servicesService
                                ->getServiceById($createBookingData['service_id'])
                                ->price,
                'therapist_id' => $createBookingData['therapist_id'],
            ]
        ];


        return DB::transaction(function () use ($bookingSpecificData, $bookingItemSpecificData) {

            $booking = Booking::create($bookingSpecificData);

            if (! $booking) {
                throw new BookingCreateFailedException(
                    'Failed to create booking. Please retry.'
                );
            }

            $booking->items()->createMany($bookingItemSpecificData);

            return $booking->load('items');
        });
   
    }

    public function getAvailableSlots(array $searchData): Collection
    {

        $slots = collect(); // slots

        $interval = 20; // interval

        $bufferMinuteStart = $this->spaSettingService
            ->getSetting()
            ->booking_buffer_start; // booking minute buffer start

        $bufferMinuteEnd = $this->spaSettingService
            ->getSetting()
            ->booking_buffer_end; // booking minute buffer end

        $dayOfWeek = Carbon::parse($searchData['booking_date'])->format('l'); // day of wee
        $serviceMinuteLength = $this->servicesService
                                    ->getServiceById($searchData['service_id'])
                                    ->duration_minutes; // service duration minutes

        $schedules = $this->scheduleService
                        ->getSchedulesByDayOfWeek($dayOfWeek); // schedules


        foreach ($schedules as $schedule) 
        {
            $startTime = Carbon::createFromFormat('H:i:s', $schedule->start_time)
                                ->addMinutes($bufferMinuteStart);

            $endTime = Carbon::createFromFormat('H:i:s', $schedule->end_time)
                                ->subMinutes($bufferMinuteEnd);

            while($startTime->copy()->addMinutes($serviceMinuteLength) < $endTime)
            {
                $slots->push((object)[
                    'start_time' => $startTime->format('h:i A'),
                    'end_time' => $startTime
                                    ->copy()
                                    ->addMinutes($serviceMinuteLength)
                                    ->format('h:i A'),
                ]);

                $startTime = $startTime
                    ->copy()
                    ->addMinutes($interval);
                
            }    
        }

        return $slots;
    }

    //echo '------------------------------------------------------------------- <br>';

        /*
        echo 'Slots: <br>';

        foreach($slots as $slot)
        {
            echo $slot['start_time'] . '-------------' . $slot['end_time'] . '<br><br>';
        }
        */

    public function getBookings(): Collection 
    {
        return Booking::with('items')
            ->with('client')
            ->orderBy('created_at', 'DESC')
            ->get();
    }
   
  
}
