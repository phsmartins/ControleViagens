<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriversTableSeeder extends Seeder
{
    public function run(): void
    {
        Driver::factory(10)->create();
    }
}
