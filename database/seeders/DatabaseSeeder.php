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

        // ─── Demo Users ─────────────────────────────────────────────────
        $users = [
            ['name' => 'Arjun Sharma',    'email' => 'arjun@example.com',  'eco_score' => 920, 'co2_saved_this_month' => 68.5, 'trips_logged' => 24],
            ['name' => 'Priya Nair',      'email' => 'priya@example.com',  'eco_score' => 870, 'co2_saved_this_month' => 52.0, 'trips_logged' => 18],
            ['name' => 'Rahul Mehta',     'email' => 'rahul@example.com',  'eco_score' => 810, 'co2_saved_this_month' => 44.3, 'trips_logged' => 15],
            ['name' => 'Deepa Iyer',      'email' => 'deepa@example.com',  'eco_score' => 755, 'co2_saved_this_month' => 39.0, 'trips_logged' => 12],
            ['name' => 'Vikram Singh',    'email' => 'vikram@example.com', 'eco_score' => 690, 'co2_saved_this_month' => 31.5, 'trips_logged' => 10],
            ['name' => 'Ananya Reddy',    'email' => 'ananya@example.com', 'eco_score' => 620, 'co2_saved_this_month' => 27.0, 'trips_logged' => 9],
            ['name' => 'Kiran Bose',      'email' => 'kiran@example.com',  'eco_score' => 540, 'co2_saved_this_month' => 22.1, 'trips_logged' => 7],
            ['name' => 'Sneha Gupta',     'email' => 'sneha@example.com',  'eco_score' => 470, 'co2_saved_this_month' => 18.5, 'trips_logged' => 6],
        ];

        $createdUsers = [];
        foreach ($users as $userData) {
            $u = User::firstOrCreate(
                ['email' => $userData['email']],
                array_merge($userData, ['password' => Hash::make('password')])
            );
            $createdUsers[] = $u;
        }

        // Primary test user
        $testUser = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name'                 => 'Eco Driver India',
                'email'                => 'test@example.com',
                'password'             => Hash::make('password'),
                'eco_score'            => 850,
                'co2_saved_this_month' => 45.5,
                'trips_logged'         => 12,
            ]
        );
        $createdUsers[] = $testUser;

        // ─── Streaks for all users ───────────────────────────────────────
        $streakDays = [14, 9, 5, 7, 3, 12, 1, 4, 6];
        foreach ($createdUsers as $i => $u) {
            UserStreak::firstOrCreate(
                ['user_id' => $u->id],
                [
                    'current_streak'     => $streakDays[$i] ?? rand(1, 10),
                    'longest_streak'     => ($streakDays[$i] ?? 5) + rand(1, 5),
                    'last_activity_date' => now()->toDateString(),
                ]
            );
        }

        // ─── Vehicles for test user ──────────────────────────────────────
        $vehicleData = [
            [
                'make' => 'Tata', 'model' => 'Nexon EV', 'year' => 2023,
                'fuel_type' => 'electric', 'engine_cc' => null,
                'co2_per_km' => 0.0, 'emission_rating' => 'A++', 'is_primary' => true,
            ],
            [
                'make' => 'Honda', 'model' => 'City', 'year' => 2021,
                'fuel_type' => 'petrol', 'engine_cc' => 1498,
                'co2_per_km' => 118.0, 'emission_rating' => 'B', 'is_primary' => false,
            ],
        ];
        foreach ($vehicleData as $vd) {
            Vehicle::firstOrCreate(
                ['user_id' => $testUser->id, 'make' => $vd['make'], 'model' => $vd['model']],
                array_merge($vd, ['user_id' => $testUser->id])
            );
        }

        // ─── Trips for all users ─────────────────────────────────────────
        $fuelTypes = ['petrol', 'diesel', 'electric', 'hybrid', 'cng'];
        $emissionFactors = ['petrol' => 0.21, 'diesel' => 0.27, 'electric' => 0.05, 'hybrid' => 0.10, 'cng' => 0.18];
        $vehicleTypes = ['Sedan', 'SUV', 'Hatchback', 'Van', 'Truck'];

        foreach ($createdUsers as $u) {
            $tripCount = $u->trips_logged ?? 10;
            for ($i = 0; $i < $tripCount; $i++) {
                $fuel = $fuelTypes[array_rand($fuelTypes)];
                $dist = rand(5, 80);
                $co2 = round($dist * $emissionFactors[$fuel], 2);
                Trip::firstOrCreate(
                    ['user_id' => $u->id, 'date' => now()->subDays($i % 30)->format('Y-m-d'), 'distance_km' => $dist],
                    [
                        'co2_emitted_kg' => $co2,
                        'fuel_type'      => $fuel,
                        'vehicle_type'   => $vehicleTypes[array_rand($vehicleTypes)],
                        'vehicle_id'     => null,
                    ]
                );
            }
        }

        // ─── Achievements for test user ──────────────────────────────────
        $firstTrip = Achievement::where('slug', 'first-trip')->first();
        $tenTrips  = Achievement::where('slug', '10-trips')->first();
        $ecoChamp  = Achievement::where('slug', 'eco-grade-a')->first();
        if ($firstTrip) {
            $testUser->achievements()->syncWithoutDetaching([
                $firstTrip->id => ['unlocked_at' => now()->subDays(10)],
            ]);
        }
        if ($tenTrips) {
            $testUser->achievements()->syncWithoutDetaching([
                $tenTrips->id => ['unlocked_at' => now()->subDays(5)],
            ]);
        }
        if ($ecoChamp) {
            $testUser->achievements()->syncWithoutDetaching([
                $ecoChamp->id => ['unlocked_at' => now()->subDays(2)],
            ]);
        }
    }
}
