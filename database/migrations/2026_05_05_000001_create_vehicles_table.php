<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('make');           // e.g. Toyota
            $table->string('model');          // e.g. Prius
            $table->integer('year');
            $table->enum('fuel_type', ['petrol', 'diesel', 'electric', 'hybrid', 'cng']);
            $table->decimal('engine_cc', 6, 0)->nullable();
            $table->decimal('co2_per_km', 6, 2); // grams CO2 per km
            $table->string('emission_rating')->default('C'); // A++ to F
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
