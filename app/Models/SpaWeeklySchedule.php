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
        'spa_id',
    ];


    public function spa()
    {
        return $this->belongsTo(Spa::class);
    }
}
