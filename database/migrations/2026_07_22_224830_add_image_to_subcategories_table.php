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
        Schema::table('subcategories', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    // Runs when rolling back the migration to drop tables
    public function down(): void
    {
        Schema::table('subcategories', function (Blueprint $table) {
            //
        });
    }
};
