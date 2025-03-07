<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_photo_path',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

  // Réservations où l'utilisateur est passager
  public function passengerBookings()
  {
      return $this->hasMany(Booking::class, 'passenger_id');
  }

  public function driverProfile()
  {
      return $this->hasOne(DriverProfile::class);
  }
    // Réservations où l'utilisateur est chauffeur
    // public function driverProfile()
    // {
    //     return $this->hasMany(DriverProfile::class ,'driver_id');
    // }
    public function driverBookings()
    {
        return $this->hasMany(Booking::class, 'driver_id');
    }

}
