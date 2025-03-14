<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehiclesTableSeeder extends Seeder
{
    public function run(): void
    {
        Vehicle::factory(10)->create();
    }
}
