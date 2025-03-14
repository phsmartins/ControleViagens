<?php

namespace Database\Factories;

use App\Models\Trip;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    protected $model = Trip::class;

    public function definition(): array
    {
        $dateStart = fake()->dateTimeBetween('-1 year', 'now');
        $dateEnd = fake()->boolean(70)
            ? fake()->dateTimeBetween($dateStart, 'now')
            : null;

        return [
            'vehicle_id' => Vehicle::inRandomOrder()->first()->id ?? Vehicle::factory(),
            'km_start' => fake()->numberBetween(10000, 200000),
            'km_end' => $dateEnd ? fake()->numberBetween(100000, 300000) : null,
            'date_start' => $dateStart,
            'date_end' => $dateEnd,
            'status' => $dateEnd ? 'completed' : 'ongoing',
        ];
    }
}
