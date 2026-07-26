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
        Schema::create('favorites', function (Blueprint $table) {
            $table->foreignUlid('user_id')->constrained()->cascadeOnDelete();
            // Creates a foreign key column to link this table to another table
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->primary(['user_id', 'product_id']);
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
        Schema::dropIfExists('favorites');
    }
};
