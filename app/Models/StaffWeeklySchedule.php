<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffWeeklySchedule extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'day_of_week',
        'start_time',
        'end_time',
        'is_unavailable',
        'is_current',
    ];

    public function staff(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
