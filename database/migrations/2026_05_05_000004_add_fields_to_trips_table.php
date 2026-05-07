<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->string('vehicle_type')->nullable()->after('date');
            $table->string('fuel_type')->nullable()->after('vehicle_type');
            $table->text('notes')->nullable()->after('fuel_type');
            $table->foreignId('vehicle_id')->nullable()->constrained()->onDelete('set null')->after('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->dropForeign(['vehicle_id']);
            $table->dropColumn(['vehicle_type', 'fuel_type', 'notes', 'vehicle_id']);
        });
    }
};
