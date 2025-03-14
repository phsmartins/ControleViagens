<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition(): array
    {
        return [
            'model' => fake()->randomElement(['Marcopolo G7', 'Mercedes-Benz O-500', 'Volvo B270F', 'Scania K360']),
            'year' => fake()->numberBetween(2010, 2023),
            'acquisition_date' => fake()->date(),
            'km_at_acquisition' => fake()->numberBetween(50000, 300000),
            'renavam' => fake()->unique()->numerify('###########'), // 11 números
            'license_plate' => strtoupper(fake()->unique()->bothify('???-####')), // Formato ABC-1234
            'status' => 'available',
        ];
    }
}
