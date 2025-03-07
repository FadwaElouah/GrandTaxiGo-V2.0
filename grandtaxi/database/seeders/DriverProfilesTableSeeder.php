<?php

namespace Database\Seeders;

use App\Models\DriverProfile;
use App\Models\User;
use Illuminate\Database\Seeder;

class DriverProfilesTableSeeder extends Seeder
{
    public function run()
    {
        $drivers = User::where('role', 'driver')->get();

        foreach ($drivers as $driver) {
            DriverProfile::create([
                'user_id' => $driver->id,
                'location_id' => 1,
                'license_number' => 'LIC' . $driver->id,
                'vehicle_make' => 'Toyota',
                'vehicle_model' => 'Corolla',
                'vehicle_color' => 'Red',
                'vehicle_plate' => 'PLATE' . $driver->id,
                'is_available' => true,
            ]);
        }
    }
}
