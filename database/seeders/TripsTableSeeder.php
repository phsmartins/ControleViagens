<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\Trip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TripsTableSeeder extends Seeder
{
    public function run(): void
    {
        Trip::factory(10)->create()->each(function ($trip) {
            $drivers = Driver::inRandomOrder()->limit(rand(1, 3))->pluck('id');
            $trip->drivers()->attach($drivers);

            $trip->vehicle->update(['status' => 'on_trip']);
            Driver::whereIn('id', $drivers)->update(['status' => 'on_trip']);
        });
    }
}
