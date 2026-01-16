<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class SpaSetting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'spa_id',  
        'email',   
        'contact_number',  
        'logo', 
        'location',   
        'maximum_bed_capacity',    
        'booking_buffer_start',    
        'booking_buffer_end',
    ];

    public function spa()
    {
        return $this->belongsTo(Spa::class);
    }

    
}
