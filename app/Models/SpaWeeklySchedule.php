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
        'spa_id',
        'day_of_week',
        'start_time',
        'end_time', 
    ];


    public function spa()
    {
        return $this->belongsTo(Spa::class);
    }
}
