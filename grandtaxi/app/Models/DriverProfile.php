<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location_id',
        'license_number',
        'vehicle_make',
        'vehicle_model',
        'vehicle_color',
        'vehicle_plate',
        'is_available',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
