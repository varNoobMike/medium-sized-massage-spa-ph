<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpaWeeklySchedule extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'day_of_week',
        'start_time',
        'end_time',
        'is_unavailable',
    ];


    /** Day of week whitelists */
    public const DAY_MON = 'Monday';
    public const DAY_TUE = 'Tuesday';
    public const DAY_WED = 'Wednesday';
    public const DAY_THU = 'Thursday';
    public const DAY_FRI = 'Friday';
    public const DAY_SAT = 'Saturday';
    public const DAY_SUN = 'Sunday';

    public const DAYS = [
        self::DAY_MON,
        self::DAY_TUE,
        self::DAY_WED,
        self::DAY_THU,
        self::DAY_FRI,
        self::DAY_SAT,
        self::DAY_SUN,
    ];


    public function spa()
    {
        return $this->belongsTo(Spa::class);
    }
}
