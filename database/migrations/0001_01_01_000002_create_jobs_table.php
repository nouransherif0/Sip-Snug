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
        Schema::create('jobs', function (Blueprint $table) {
            // Creates an auto-incrementing primary key column named ID
            $table->id();
            // Creates a standard text string column in the database
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedSmallInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        // Instructs the database to create a new table
        Schema::create('job_batches', function (Blueprint $table) {
            // Creates a standard text string column in the database
            $table->string('id')->primary();
            // Creates a standard text string column in the database
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        // Instructs the database to create a new table
        Schema::create('failed_jobs', function (Blueprint $table) {
            // Creates an auto-incrementing primary key column named ID
            $table->id();
            // Creates a standard text string column in the database
            $table->string('uuid')->unique();
            // Creates a standard text string column in the database
            $table->string('connection');
            // Creates a standard text string column in the database
            $table->string('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();

            $table->index(['connection', 'queue', 'failed_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    // Runs when rolling back the migration to drop tables
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');
    }
};
