<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  // Runs when migrating the database to create or modify tables
  public function up(): void
{
    // Instructs the database to create a new table
    Schema::create('cart_items', function (Blueprint $table) {
        // Creates an auto-incrementing primary key column named ID
        $table->id();
        $table->foreignUlid('cart_id')->constrained('carts')->onDelete('cascade');
        // Creates a foreign key column to link this table to another table
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        $table->integer('quantity');
        $table->json('add_ons')->nullable();
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
        Schema::dropIfExists('cart_items');
    }
};
