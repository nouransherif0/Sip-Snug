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
    Schema::create('order_item_addons', function (Blueprint $table) {
        // Creates an auto-incrementing primary key column named ID
        $table->id();
        // Creates a foreign key column to link this table to another table
        $table->foreignId('order_item_id')->constrained()->onDelete('cascade');
        // Creates a foreign key column to link this table to another table
        $table->foreignId('addon_id')->constrained('add_ons')->onDelete('cascade');
        $table->decimal('price_adjustment', 8, 2);
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
        Schema::dropIfExists('order_item_addons');
    }
};
