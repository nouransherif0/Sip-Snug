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
        Schema::create('saved_cards', function (Blueprint $table) {
            // Creates an auto-incrementing primary key column named ID
            $table->id();
            $table->foreignUlid('user_id')->constrained()->cascadeOnDelete();
            // Creates a standard text string column in the database
            $table->string('card_type'); // visa, mastercard, etc.
            // Creates a standard text string column in the database
            $table->string('card_name');
            // Creates a standard text string column in the database
            $table->string('card_number');
            // Creates a standard text string column in the database
            $table->string('expiry_date');
            // Creates a standard text string column in the database
            $table->string('cvv');
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
        Schema::dropIfExists('saved_cards');
    }
};
