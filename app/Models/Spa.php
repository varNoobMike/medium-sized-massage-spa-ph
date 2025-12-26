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
        'address',
        'date_founded',
        'total_beds',
        'user_id',
    ];



    public function spaWeeklySchedule()
    {
        return $this->hasMany(SpaWeeklySchedule::class);
    }

    
}
