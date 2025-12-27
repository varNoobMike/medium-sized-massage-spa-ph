<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spa extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'is_main_branch',
        'address',
        'date_founded',
        'total_beds',
        'created_by'
    ];



    public function spaWeeklySchedules()
    {
        return $this->hasMany(SpaWeeklySchedule::class);
    }

    
}
