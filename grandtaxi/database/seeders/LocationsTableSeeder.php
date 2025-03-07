<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('locations')->insert([
            ['name' => 'marrakech', 'latitude' => 12.34, 'longitude' => 56.78],
            ['name' => 'Safi B', 'latitude' => 23.45, 'longitude' => 67.89],
        ]);
    }
}
