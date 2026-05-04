<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leaderboard', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->unique();
            $table->decimal('total_eco_score', 10, 2)->default(0);
            $table->unsignedInteger('total_trips')->default(0);
            $table->decimal('total_co2_saved', 10, 4)->default(0);
            $table->unsignedInteger('rank')->default(0);
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leaderboard');
    }
};
