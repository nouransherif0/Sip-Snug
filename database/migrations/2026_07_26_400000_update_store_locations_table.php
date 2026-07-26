<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('store_locations', function (Blueprint $table) {
            $table->string('status')->default('open')->after('google_maps_url');
            $table->string('days_label')->default('Daily')->nullable()->after('working_hours');
            $table->string('opening_time')->nullable()->after('days_label');
            $table->string('closing_time')->nullable()->after('opening_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('store_locations', function (Blueprint $table) {
            $table->dropColumn(['status', 'days_label', 'opening_time', 'closing_time']);
        });
    }
};
