<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Spa;


class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'duration_minutes',
        'price',
    ];



    public function spa()
    {
        return $this->belongsTo(Spa::class);
    }
}
