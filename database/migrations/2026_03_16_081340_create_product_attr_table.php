<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        //"id": 5,
        //"name": "ширина",
        //"slug": "pa_ccolor",
        //"type": "select",
        //"order_by": "menu_order",
        //"has_archives": false,

        Schema::create('attr', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();

            $table->string('slug');

            $table->string('name');
            $table->json('names')->nullable()->comment('name translations');

            $table->string('type')->nullable();
            $table->string('order_by')->nullable()->default('menu_order');
            $table->boolean('has_archives')->nullable()->default(false);

            $table->timestamps();
        });

        Schema::create('product_attr', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('attr_id');
            $table->foreign('attr_id')->references('id')->on('attr')->cascadeOnDelete();

            $table->unique(['product_id', 'attr_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_attr');
        Schema::dropIfExists('attr');
    }
};
