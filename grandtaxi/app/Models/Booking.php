<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'passenger_id',
        'driver_id',
        'pickup_location_id',
        'destination_location_id',
        'scheduled_at',
        'status',
        'canceled_at',
        'created_at',
        'updated_at', 
    ];

    // Add this to cast scheduled_at as a date
    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function pickupLocation()
    {
        return $this->belongsTo(Location::class, 'pickup_location_id');
    }

    public function destinationLocation()
    {
        return $this->belongsTo(Location::class, 'destination_location_id');
    }

    // // Scopes
 public function scopePending($query)
 {
     return $query->where('status', 'pending');
 }

 public function scopeConfirmed($query)
 {
     return $query->where('status', 'confirmed');
 }

 public function scopeCanceled($query)
 {
     return $query->where('status', 'canceled');
 }



    // {
    //     return $this->belongsTo(Location::class, 'location_id');
    // }
}
