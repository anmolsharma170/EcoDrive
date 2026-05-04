<?php

namespace Database\Seeders;

use App\Models\EcoTip;
use Illuminate\Database\Seeder;

class EcoTipSeeder extends Seeder
{
    public function run(): void
    {
        $tips = [
            [
                'title'       => 'Maintain Steady Speed',
                'description' => 'Keeping a consistent speed reduces fuel consumption by up to 20%. Use cruise control on highways when possible.',
                'category'    => 'driving',
                'is_active'   => true,
            ],
            [
                'title'       => 'Anticipate Traffic',
                'description' => 'Look ahead and anticipate stops to avoid aggressive braking. Smooth deceleration saves fuel and reduces brake wear.',
                'category'    => 'driving',
                'is_active'   => true,
            ],
            [
                'title'       => 'Reduce Idling Time',
                'description' => 'Turn off your engine if you expect to wait more than 60 seconds. Idling wastes about 0.6L of fuel per hour.',
                'category'    => 'driving',
                'is_active'   => true,
            ],
            [
                'title'       => 'Drive at Optimal Speed',
                'description' => 'Most vehicles achieve best fuel efficiency between 50–90 km/h. Driving at 120 km/h uses up to 20% more fuel than at 100 km/h.',
                'category'    => 'driving',
                'is_active'   => true,
            ],
            [
                'title'       => 'Check Tyre Pressure Monthly',
                'description' => 'Under-inflated tyres increase rolling resistance. Properly inflated tyres can improve fuel efficiency by up to 3%.',
                'category'    => 'maintenance',
                'is_active'   => true,
            ],
            [
                'title'       => 'Service Your Vehicle Regularly',
                'description' => 'A well-maintained engine runs more efficiently. Regular oil changes and air filter replacements can improve mileage by 4–40%.',
                'category'    => 'maintenance',
                'is_active'   => true,
            ],
            [
                'title'       => 'Remove Excess Weight',
                'description' => 'Every 50 kg of extra weight reduces fuel efficiency by about 1–2%. Remove roof racks and heavy cargo when not needed.',
                'category'    => 'maintenance',
                'is_active'   => true,
            ],
            [
                'title'       => 'Choose the Right Fuel Grade',
                'description' => 'Using the manufacturer-recommended fuel grade prevents engine knock and leads to better combustion efficiency.',
                'category'    => 'fuel',
                'is_active'   => true,
            ],
            [
                'title'       => 'Consider Electric or Hybrid Vehicles',
                'description' => 'Electric vehicles produce zero direct emissions. Even hybrids can reduce CO2 output by 30–50% compared to conventional cars.',
                'category'    => 'fuel',
                'is_active'   => true,
            ],
            [
                'title'       => 'Use Air Conditioning Sparingly',
                'description' => 'AC can increase fuel consumption by 5–25%. At low speeds, open windows; at highway speeds, AC is more aerodynamically efficient.',
                'category'    => 'fuel',
                'is_active'   => true,
            ],
        ];

        foreach ($tips as $tip) {
            EcoTip::create($tip);
        }
    }
}
