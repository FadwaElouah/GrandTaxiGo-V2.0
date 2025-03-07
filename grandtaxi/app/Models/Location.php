<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'latitude',
        'longitude',
    ];


    public function driverProfiles() {
        return $this->hasMany(DriverProfile::class, 'location_id');
    }
    public function pickupBookings() {
        return $this->hasMany(Booking::class, 'pickup_location_id');
    }

    public function destinationBookings() {
        return $this->hasMany(Booking::class, 'destination_location_id');
    }
}
