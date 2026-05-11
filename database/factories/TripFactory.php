<?php

namespace Database\Factories;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'distance_km' => $this->faker->randomFloat(2, 1, 100),
            'co2_emitted_kg' => $this->faker->randomFloat(2, 0, 50),
            'date' => $this->faker->date(),
            'vehicle_type' => $this->faker->word(),
            'fuel_type' => $this->faker->randomElement(['petrol', 'diesel', 'electric', 'hybrid']),
            'notes' => $this->faker->sentence(),
        ];
    }
}
