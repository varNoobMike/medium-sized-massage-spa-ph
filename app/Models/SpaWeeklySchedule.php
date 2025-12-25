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
        'open_time',
        'close_time',
        'is_closed',
        'created_by'
    ];

    public function spa()
    {
        return $this->belongsTo(Spa::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
