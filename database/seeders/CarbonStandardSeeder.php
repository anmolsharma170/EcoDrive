<?php

namespace Database\Seeders;

use App\Models\CarbonStandard;
use Illuminate\Database\Seeder;

class CarbonStandardSeeder extends Seeder
{
    public function run(): void
    {
        $standards = [
            ['fuel_type' => 'petrol',   'emission_factor' => 2.3100],
            ['fuel_type' => 'diesel',   'emission_factor' => 2.6800],
            ['fuel_type' => 'electric', 'emission_factor' => 0.2330],
            ['fuel_type' => 'hybrid',   'emission_factor' => 1.1500],
        ];

        foreach ($standards as $standard) {
            CarbonStandard::updateOrCreate(
                ['fuel_type' => $standard['fuel_type']],
                ['emission_factor' => $standard['emission_factor']]
            );
        }
    }
}
