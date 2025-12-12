<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('product_upsells', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->unsignedBigInteger('upsell_product_id');
            $table->foreign('upsell_product_id')->references('id')->on('products')->cascadeOnDelete();

            $table->index('upsell_product_id');
            $table->unique(['product_id', 'upsell_product_id']);
        });

        Schema::create('product_cross_sells', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->unsignedBigInteger('cross_sell_product_id');
            $table->foreign('cross_sell_product_id')->references('id')->on('products')->cascadeOnDelete();

            $table->index('cross_sell_product_id');
            $table->unique(['product_id', 'cross_sell_product_id']);
        });

        Schema::create('product_related', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->unsignedBigInteger('related_product_id');
            $table->foreign('related_product_id')->references('id')->on('products')->cascadeOnDelete();

            $table->index('related_product_id');
            $table->unique(['product_id', 'related_product_id']);
        });

        Schema::create('product_grouped', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->unsignedBigInteger('child_product_id');
            $table->foreign('child_product_id')->references('id')->on('products')->cascadeOnDelete();

            $table->index('child_product_id');
            $table->unique(['product_id', 'child_product_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_upsells');
        Schema::dropIfExists('product_cross_sells');
        Schema::dropIfExists('product_related');
        Schema::dropIfExists('product_grouped');
    }
};
