<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        //  "id": 85,
        //  "name": "Стрічка Репсова Віп якості однотонна",
        //  "slug": "strichka-repsova-vip-yakosti-odnotonna",
        //  "count": 154,
        //  "parent": 3404,
        //  "display": "both",
        //  "menu_order": 199,
        //  "description": "\r\n"

        Schema::create('categories', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('name');
            $table->string('slug');
            $table->json('names')->nullable()->comment('name translations');
            $table->integer('count')->nullable()->comment('products count used this category');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('display')->nullable()->comment('display enum');
            $table->integer('menu_order')->nullable();
            $table->text('description')->nullable();
            $table->json('descriptions')->nullable()->comment('description translations');
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('categories')->nullOnDelete();
        });

        Schema::create('product_categories', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();

            $table->unique(['product_id', 'category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('categories');
    }
};
