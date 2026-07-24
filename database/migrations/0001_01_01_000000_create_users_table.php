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
        Schema::create('users', function (Blueprint $table) {
            $table->ulid('id')->primary();
            // Creates a standard text string column in the database
            $table->string('name');
            // Creates a standard text string column in the database
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            // Creates a standard text string column in the database
            $table->string('password');
            // Creates a standard text string column in the database
            $table->string('phone')->nullable();
            $table->enum('role', ['admin', 'customer', 'delivery'])->default('customer');
            $table->rememberToken();
            // Automatically creates created_at and updated_at timestamp columns
            $table->timestamps();
        });

        // Instructs the database to create a new table
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            // Creates a standard text string column in the database
            $table->string('email')->primary();
            // Creates a standard text string column in the database
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Instructs the database to create a new table
        Schema::create('sessions', function (Blueprint $table) {
            // Creates a standard text string column in the database
            $table->string('id')->primary();
            $table->foreignUlid('user_id')->nullable()->index();
            // Creates a standard text string column in the database
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    // Runs when rolling back the migration to drop tables
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};