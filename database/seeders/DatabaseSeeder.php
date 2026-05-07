<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\EcoTip;
use App\Models\Trip;
use App\Models\User;
use App\Models\UserStreak;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Achievements ────────────────────────────────────────────────
        $achievements = [
            ['slug' => 'first-trip',       'name' => 'First Green Trip',   'icon' => '🌱', 'description' => 'Logged your very first trip on Eco Drive.',     'points' => 10,  'color' => '#00FF87'],
            ['slug' => '10-trips',         'name' => '10 Trips Club',      'icon' => '🚗', 'description' => 'Logged 10 trips. You\'re building a habit!',    'points' => 50,  'color' => '#4ECDC4'],
            ['slug' => '100km-club',       'name' => '100 km Club',        'icon' => '🛣️', 'description' => 'Driven 100km tracked on Eco Drive.',            'points' => 100, 'color' => '#45B7D1'],
            ['slug' => 'low-emitter',      'name' => 'Low Carbon Hero',    'icon' => '🌿', 'description' => 'Logged a trip with under 1kg CO2 emitted.',      'points' => 25,  'color' => '#96CEB4'],
            ['slug' => 'electric-pioneer', 'name' => 'Electric Pioneer',   'icon' => '⚡', 'description' => 'Logged your first electric vehicle trip.',       'points' => 75,  'color' => '#FFC107'],
            ['slug' => 'streak-7',         'name' => 'Green Week',         'icon' => '🔥', 'description' => 'Maintained a 7-day driving streak.',            'points' => 60,  'color' => '#FF6B6B'],
            ['slug' => 'eco-grade-a',      'name' => 'Eco Champion',       'icon' => '🏆', 'description' => 'Achieved an A grade eco score.',                'points' => 150, 'color' => '#FFD700'],
        ];
        foreach ($achievements as $a) {
            Achievement::firstOrCreate(['slug' => $a['slug']], $a);
        }

        // ─── Eco Tips ────────────────────────────────────────────────────
        $tips = [
            ['title' => 'Inflate Your Tires',         'description' => 'Properly inflated tires reduce rolling resistance and improve fuel efficiency by up to 3%. Check pressures monthly.',     'estimated_co2_savings_kg' => 20.0, 'category' => 'maintenance', 'icon' => '🔧'],
            ['title' => 'Avoid Aggressive Braking',   'description' => 'Smooth braking and acceleration can cut fuel consumption by 15-30%. Anticipate traffic flow and coast when possible.',    'estimated_co2_savings_kg' => 35.0, 'category' => 'driving',     'icon' => '🚦'],
            ['title' => 'Switch Off When Idling',     'description' => 'Idling burns fuel unnecessarily. Turn off the engine if you\'ll be stationary for more than 30 seconds.',                'estimated_co2_savings_kg' => 15.5, 'category' => 'driving',     'icon' => '⏸️'],
            ['title' => 'Drive at Optimal Speed',     'description' => 'Most vehicles are most fuel-efficient between 50-90 km/h. Driving at 120 km/h uses up to 20% more fuel than at 80 km/h.','estimated_co2_savings_kg' => 45.0, 'category' => 'driving',     'icon' => '🏎️'],
            ['title' => 'Regular Engine Servicing',   'description' => 'A well-tuned engine runs more efficiently. Regular servicing including air filter changes can improve fuel economy by 4%.','estimated_co2_savings_kg' => 18.0, 'category' => 'maintenance', 'icon' => '🔩'],
            ['title' => 'Reduce Air Conditioning',    'description' => 'AC can increase fuel consumption by up to 20% at low speeds. Open windows at city speeds; use AC only on highways.',      'estimated_co2_savings_kg' => 25.0, 'category' => 'driving',     'icon' => '❄️'],
            ['title' => 'Plan Your Route',            'description' => 'Using real-time navigation avoids traffic jams and saves fuel. Planning trips reduces unnecessary mileage.',              'estimated_co2_savings_kg' => 12.0, 'category' => 'planning',    'icon' => '🗺️'],
            ['title' => 'Carpool When Possible',      'description' => 'Sharing a car with even one other person halves your per-person carbon footprint. Use carpool apps for commutes.',        'estimated_co2_savings_kg' => 80.0, 'category' => 'planning',    'icon' => '👥'],
            ['title' => 'Remove Unnecessary Weight',  'description' => 'Every 45kg of extra weight reduces fuel efficiency by about 1-2%. Clear out heavy items from your car boot.',           'estimated_co2_savings_kg' => 8.0,  'category' => 'maintenance', 'icon' => '⚖️'],
            ['title' => 'Use Higher Gears Early',     'description' => 'Shift to higher gears sooner for petrol/diesel vehicles. Driving at lower RPMs reduces fuel consumption significantly.',  'estimated_co2_savings_kg' => 22.0, 'category' => 'driving',     'icon' => '⬆️'],
            ['title' => 'Consider an EV or Hybrid',  'description' => 'Electric vehicles produce zero direct emissions. Even hybrids reduce CO2 by 30-50% compared to petrol equivalents.',     'estimated_co2_savings_kg' => 200.0,'category' => 'vehicle',     'icon' => '⚡'],
            ['title' => 'Combine Multiple Errands',  'description' => 'Plan your day to combine multiple errands into one trip. A warm engine is more fuel-efficient than multiple cold starts.',  'estimated_co2_savings_kg' => 15.0, 'category' => 'planning',    'icon' => '📋'],
        ];
        foreach ($tips as $tip) {
            EcoTip::firstOrCreate(['title' => $tip['title']], $tip);
        }

        // ─── Users, Vehicles, Trips ──────────────────────────────────────
        // Create a main user for easy login
        $mainUser = User::factory()->create([
            'name' => 'Alex Green',
            'email' => 'alex@ecodrive.com',
            'password' => Hash::make('password'),
            'co2_saved_this_month' => 25.5,
            'points' => 1250,
        ]);

        // Create 20 other random users
        User::factory(20)->create();

        // Create vehicles and trips for all users
        User::all()->each(function ($user) {
            // Give each user 1-2 vehicles
            Vehicle::factory(rand(1, 2))->create(['user_id' => $user->id]);

            // Give each user 5-50 trips
            if ($user->vehicles->count() > 0) {
                Trip::factory(rand(5, 50))->create([
                    'user_id' => $user->id,
                    'vehicle_id' => $user->vehicles->random()->id,
                ]);
            }

            // Create a streak for the user
            UserStreak::factory()->create(['user_id' => $user->id]);
        });
    }
}
