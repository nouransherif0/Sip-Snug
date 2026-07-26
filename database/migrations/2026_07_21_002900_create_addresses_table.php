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
        // Instructs the database to create a new table
        Schema::create('addresses', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('user_id')->constrained()->cascadeOnDelete();
            // Creates a foreign key column to link this table to another table
            $table->foreignId('delivery_zone_id')->constrained('delivery_zones')->cascadeOnDelete();
            // Creates a standard text string column in the database
            $table->string('label')->nullable();
            $table->text('street');
            // Creates a standard text string column in the database
            $table->string('building_number');
            // Creates a standard text string column in the database
            $table->string('floor')->nullable();
            // Creates a standard text string column in the database
            $table->string('apartment')->nullable();
            // Creates a standard text string column in the database
            $table->string('landmark')->nullable();
            // Creates a standard text string column in the database
            $table->string('phone_number');
            $table->boolean('is_default')->default(false);
            // Automatically creates created_at and updated_at timestamp columns
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    // Runs when rolling back the migration to drop tables
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
