<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Mime\Email;

class Spa extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
    ];


    public function spaSetting()
    {
        return $this->hasOne(SpaSetting::class);
    }


    public function services()
    {
        return $this->hasMany(Service::class);
    }



    public function spaWeeklySchedules()
    {
        return $this->hasMany(SpaWeeklySchedule::class);
    }


    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

}
