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
        'company_id',
        'is_main_branch',
        'location',
        'total_beds',
    ];

    public function spaWeeklySchedules()
    {
        return $this->hasMany(SpaWeeklySchedule::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'spa_services', 'spa_id', 'service_id')
            ->withTimestamps();
    }

    public function staffs()
    {
        return $this->belongsToMany(User::class, 'spa_staff', 'spa_id', 'user_id')
            ->withTimestamps();
    }
}
