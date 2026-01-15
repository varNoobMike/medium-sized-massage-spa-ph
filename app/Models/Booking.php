<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'client_id',
        'spa_id',
        'booking_date',
        'start_time',
        'end_time',
        'status',
        'total_amount',
        'notes'
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function spa()
    {
        return $this->belongsTo(Spa::class);
    }

    public function items()
    {
        return $this->hasMany(BookingItem::class);
    }
}
