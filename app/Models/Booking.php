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

    public const STATUS_PENDING = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_ONGOING = 'ongoing';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_FINISHED = 'finished';


    public const STATUS = [
        self::STATUS_PENDING,
        self::STATUS_CONFIRMED,
        self::STATUS_ONGOING,
        self::STATUS_CANCELLED,
        self::STATUS_FINISHED
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function items()
    {
        return $this->hasMany(BookingItem::class);
    }
}
