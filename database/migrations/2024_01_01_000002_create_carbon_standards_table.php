<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carbon_standards', function (Blueprint $table) {
            $table->id();
            $table->enum('fuel_type', ['petrol', 'diesel', 'electric', 'hybrid'])->unique();
            $table->decimal('emission_factor', 8, 4)->comment('kg CO2 per litre (or kWh equivalent)');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carbon_standards');
    }
};
