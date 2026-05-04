<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->decimal('distance_km', 10, 2);
            $table->decimal('fuel_consumed', 10, 2)->comment('litres or kWh');
            $table->decimal('carbon_emission', 10, 4)->default(0)->comment('kg CO2');
            $table->decimal('eco_points_earned', 10, 4)->default(0);
            $table->date('trip_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
