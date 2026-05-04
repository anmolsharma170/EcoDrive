<?php

namespace Database\Seeders;

use App\Models\Leaderboard;
use App\Models\Trip;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\CarbonStandard;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        $admin = User::create([
            'name'      => 'Admin User',
            'email'     => 'admin@ecodrive.com',
            'password'  => Hash::make('password'),
            'role'      => 'admin',
            'eco_score' => 0,
        ]);

        // Regular users
        $usersData = [
            ['name' => 'Alice Green',   'email' => 'alice@example.com'],
            ['name' => 'Bob Eco',       'email' => 'bob@example.com'],
            ['name' => 'Clara Miles',   'email' => 'clara@example.com'],
            ['name' => 'David Watts',   'email' => 'david@example.com'],
            ['name' => 'Eva Leaf',      'email' => 'eva@example.com'],
        ];

        $vehicleTemplates = [
            [
                ['vehicle_name' => 'Honda City',    'vehicle_type' => 'car',   'fuel_type' => 'petrol'],
                ['vehicle_name' => 'Yamaha FZ',     'vehicle_type' => 'bike',  'fuel_type' => 'petrol'],
                ['vehicle_name' => 'Tata Nexon EV', 'vehicle_type' => 'car',   'fuel_type' => 'electric'],
            ],
            [
                ['vehicle_name' => 'Toyota Camry',  'vehicle_type' => 'car',   'fuel_type' => 'hybrid'],
                ['vehicle_name' => 'Hero Splendor', 'vehicle_type' => 'bike',  'fuel_type' => 'petrol'],
                ['vehicle_name' => 'Mahindra Scorpio','vehicle_type'=> 'car',  'fuel_type' => 'diesel'],
            ],
            [
                ['vehicle_name' => 'Hyundai Creta', 'vehicle_type' => 'car',   'fuel_type' => 'petrol'],
                ['vehicle_name' => 'Royal Enfield', 'vehicle_type' => 'bike',  'fuel_type' => 'petrol'],
                ['vehicle_name' => 'Bajaj RE Auto', 'vehicle_type' => 'truck', 'fuel_type' => 'diesel'],
            ],
            [
                ['vehicle_name' => 'Tesla Model 3', 'vehicle_type' => 'car',   'fuel_type' => 'electric'],
                ['vehicle_name' => 'KTM Duke',      'vehicle_type' => 'bike',  'fuel_type' => 'petrol'],
                ['vehicle_name' => 'Ford Endeavour','vehicle_type' => 'car',   'fuel_type' => 'diesel'],
            ],
            [
                ['vehicle_name' => 'Maruti Swift',  'vehicle_type' => 'car',   'fuel_type' => 'petrol'],
                ['vehicle_name' => 'Honda Activa',  'vehicle_type' => 'bike',  'fuel_type' => 'petrol'],
                ['vehicle_name' => 'MG ZS EV',      'vehicle_type' => 'car',   'fuel_type' => 'electric'],
            ],
        ];

        $standards = CarbonStandard::pluck('emission_factor', 'fuel_type')->toArray();

        $tripTemplates = [
            ['distance_km' => 25.5, 'fuel_consumed' => 2.1],
            ['distance_km' => 40.0, 'fuel_consumed' => 3.5],
            ['distance_km' => 12.8, 'fuel_consumed' => 1.2],
            ['distance_km' => 60.0, 'fuel_consumed' => 5.0],
            ['distance_km' => 18.3, 'fuel_consumed' => 1.8],
        ];

        foreach ($usersData as $i => $userData) {
            $user = User::create([
                'name'      => $userData['name'],
                'email'     => $userData['email'],
                'password'  => Hash::make('password'),
                'role'      => 'user',
                'eco_score' => 0,
            ]);

            $vehicles = [];
            foreach ($vehicleTemplates[$i] as $vData) {
                $vehicles[] = Vehicle::create(array_merge(['user_id' => $user->id], $vData));
            }

            $totalEcoScore  = 0;
            $totalCo2Saved  = 0;
            $tripCount      = 0;

            foreach ($tripTemplates as $j => $tripData) {
                $vehicle         = $vehicles[$j % count($vehicles)];
                $emissionFactor  = $standards[$vehicle->fuel_type] ?? 2.31;
                $carbonEmission  = round($tripData['fuel_consumed'] * $emissionFactor, 4);
                $ecoPoints       = $carbonEmission > 0
                    ? round($tripData['distance_km'] / $carbonEmission, 4)
                    : 0;

                Trip::create([
                    'user_id'          => $user->id,
                    'vehicle_id'       => $vehicle->id,
                    'distance_km'      => $tripData['distance_km'],
                    'fuel_consumed'    => $tripData['fuel_consumed'],
                    'carbon_emission'  => $carbonEmission,
                    'eco_points_earned'=> $ecoPoints,
                    'trip_date'        => now()->subDays(($j + 1) * 3)->toDateString(),
                ]);

                $totalEcoScore += $ecoPoints;
                $totalCo2Saved += $carbonEmission;
                $tripCount++;
            }

            $user->update(['eco_score' => round($totalEcoScore, 2)]);

            Leaderboard::create([
                'user_id'        => $user->id,
                'total_eco_score'=> round($totalEcoScore, 2),
                'total_trips'    => $tripCount,
                'total_co2_saved'=> round($totalCo2Saved, 4),
                'rank'           => 0,
                'updated_at'     => now(),
            ]);
        }

        // Re-rank leaderboard
        $entries = Leaderboard::orderByDesc('total_eco_score')->get();
        foreach ($entries as $rank => $entry) {
            $entry->update(['rank' => $rank + 1]);
        }
    }
}
