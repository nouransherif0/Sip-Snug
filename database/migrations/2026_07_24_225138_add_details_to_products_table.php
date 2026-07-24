<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('calories')->nullable()->default(180);
            $table->integer('prep_time')->nullable()->default(5);
            $table->decimal('discount_price', 8, 2)->nullable();
            $table->boolean('is_bestseller')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['calories', 'prep_time', 'discount_price', 'is_bestseller']);
        });
    }
};
