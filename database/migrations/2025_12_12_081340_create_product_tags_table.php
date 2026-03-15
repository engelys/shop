<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        //"id": 1937,
        //"name": "New",
        //"slug": "new",
        //"count": 0,
        //"description": ""

        Schema::create('tags', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();

            $table->string('slug');

            $table->string('name');
            $table->json('names')->nullable()->comment('name translations');

            $table->text('description')->nullable();
            $table->json('descriptions')->nullable()->comment('description translations');

            $table->integer('count')->default(0)->comment('products count used this tag');

            $table->timestamps();
        });

        Schema::create('product_tags', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id')->references('id')->on('tags')->cascadeOnDelete();

            $table->unique(['product_id', 'tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_tags');
        Schema::dropIfExists('tags');
    }
};
