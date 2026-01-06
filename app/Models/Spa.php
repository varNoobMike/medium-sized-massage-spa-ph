<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class Spa extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'location',
        'total_beds',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function spaWeeklySchedules()
    {
        return $this->hasMany(SpaWeeklySchedule::class);
    }
}
