<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('wp_data', function (Blueprint $table) {
            $table->id();

            // request details
            $table->string('type')->index(); // request type, products collection / product record / categories...
            $table->integer('status'); // request status

            // response data details
            $table->integer('key')->index()->nullable(); // entity identification for single record response
            $table->json('data')->nullable(); // json response data

            $table->timestamps();

            $table->unique('key', 'type');
        });
    }

    public function down(): void
    {
        Schema::drop('wp_data');
    }
};
