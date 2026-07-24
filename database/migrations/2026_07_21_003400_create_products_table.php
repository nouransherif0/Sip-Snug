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
    Schema::create('products', function (Blueprint $table) {
        // Creates an auto-incrementing primary key column named ID
        $table->id();
        // Creates a foreign key column to link this table to another table
        $table->foreignId('subcategory_id')->constrained()->onDelete('cascade');
        // Creates a standard text string column in the database
        $table->string('name');
        $table->text('description')->nullable();
        $table->decimal('price', 8, 2);
        // Creates a standard text string column in the database
        $table->string('image')->nullable();
        $table->integer('stock');
        $table->boolean('is_featured')->default(false);
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
        Schema::dropIfExists('products');
    }
};
