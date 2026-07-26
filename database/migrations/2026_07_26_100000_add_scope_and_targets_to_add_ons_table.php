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
        Schema::table('add_ons', function (Blueprint $table) {
            $table->string('scope')->default('global')->after('price_adjustment');
            $table->foreignId('category_id')->nullable()->after('scope')->constrained('categories')->onDelete('cascade');
            $table->foreignId('subcategory_id')->nullable()->after('category_id')->constrained('subcategories')->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->after('subcategory_id')->constrained('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('add_ons', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['subcategory_id']);
            $table->dropForeign(['product_id']);
            $table->dropColumn(['scope', 'category_id', 'subcategory_id', 'product_id']);
        });
    }
};
