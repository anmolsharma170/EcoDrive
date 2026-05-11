<?php

namespace Database\Factories;

use App\Models\UserStreak;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserStreak>
 */
class UserStreakFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'current_streak' => $this->faker->numberBetween(0, 10),
            'longest_streak' => $this->faker->numberBetween(10, 50),
            'last_activity_date' => $this->faker->date(),
        ];
    }
}
