<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('company')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('phone')->nullable();

            $table->string('type')->default('billing');
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['customer_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_addresses');
    }
};
