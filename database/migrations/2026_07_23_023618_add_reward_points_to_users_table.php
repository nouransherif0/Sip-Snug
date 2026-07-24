<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Runs when migrating the database to create or modify tables
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('reward_points')->default(0)->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    // Runs when rolling back the migration to drop tables
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('reward_points');
        });
    }
};
