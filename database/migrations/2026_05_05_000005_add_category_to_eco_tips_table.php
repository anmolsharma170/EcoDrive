<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('eco_tips', function (Blueprint $table) {
            $table->string('category')->default('general')->after('estimated_co2_savings_kg');
            $table->string('icon')->default('💡')->after('category');
        });
    }

    public function down(): void
    {
        Schema::table('eco_tips', function (Blueprint $table) {
            $table->dropColumn(['category', 'icon']);
        });
    }
};
