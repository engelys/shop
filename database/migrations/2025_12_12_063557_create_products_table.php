<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');

            $table->string('permalink')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable();

            $table->string('catalog_visibility')->nullable();
            $table->string('sku')->nullable();
            $table->string('regular_price')->nullable();
            $table->string('sale_price')->nullable();
            $table->string('date_on_sale_from')->nullable();
            $table->string('date_on_sale_to')->nullable();
            $table->string('external_url')->nullable();
            $table->string('low_stock_amount')->nullable();
            $table->string('weight')->nullable();
            $table->string('shipping_class')->nullable();
            $table->string('average_rating')->nullable();
            $table->string('price_html')->nullable();
            $table->string('stock_status')->nullable();

            $table->text('description')->nullable();
            $table->text('short_description')->nullable();

            $table->boolean('featured')->nullable();
            $table->boolean('on_sale')->nullable();
            $table->boolean('purchasable')->nullable();
            $table->boolean('virtual')->nullable();
            $table->boolean('downloadable')->nullable();
            $table->boolean('manage_stock')->nullable();
            $table->boolean('sold_individually')->nullable();
            $table->boolean('shipping_required')->nullable();
            $table->boolean('shipping_taxable')->nullable();
            $table->boolean('reviews_allowed')->nullable();
            $table->boolean('has_options')->nullable();

            $table->integer('price')->nullable();
            $table->integer('total_sales')->nullable();
            $table->integer('stock_quantity')->nullable();
            $table->integer('shipping_class_id')->nullable();
            $table->integer('rating_count')->nullable();
            $table->integer('menu_order')->nullable();

            $table->integer('parent_id')->index()->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
