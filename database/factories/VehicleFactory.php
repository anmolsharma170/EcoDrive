<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'make' => $this->faker->randomElement(['Toyota', 'Honda', 'Ford', 'Tesla', 'Nissan']),
            'model' => $this->faker->word(),
            'year' => $this->faker->numberBetween(2010, 2023),
            'fuel_type' => $this->faker->randomElement(['petrol', 'diesel', 'electric', 'hybrid']),
            'engine_cc' => $this->faker->numberBetween(1000, 3000),
            'co2_per_km' => $this->faker->randomFloat(2, 0, 300),
            'emission_rating' => $this->faker->randomElement(['A++', 'A+', 'A', 'B', 'C', 'D', 'E', 'F']),
            'is_primary' => $this->faker->boolean(),
        ];
    }
}
