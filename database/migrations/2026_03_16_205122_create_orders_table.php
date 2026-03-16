<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->unsignedBigInteger('id')->primary();

            $table->unsignedBigInteger('parent_id')->nullable()->index();
            $table->string('number')->nullable()->index();
            $table->string('status')->index();
            $table->string('currency', 10)->nullable();
            $table->boolean('prices_include_tax')->nullable();

            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete();

            $table->decimal('discount_total', 12)->nullable();
            $table->decimal('discount_tax', 12)->nullable();
            $table->decimal('shipping_total', 12)->nullable();
            $table->decimal('shipping_tax', 12)->nullable();
            $table->decimal('cart_tax', 12)->nullable();
            $table->decimal('total', 12)->nullable();
            $table->decimal('total_tax', 12)->nullable();

            $table->string('order_key')->nullable()->index();
            $table->string('payment_method')->nullable();
            $table->string('payment_method_title')->nullable();
            $table->string('transaction_id')->nullable()->index();
            $table->string('created_via')->nullable();
            $table->string('cart_hash')->nullable();
            $table->text('payment_url')->nullable();

            $table->boolean('is_editable')->nullable();
            $table->boolean('needs_payment')->nullable();
            $table->boolean('needs_processing')->nullable();

            $table->timestamp('date_paid')->nullable();
            $table->timestamp('date_completed')->nullable();

            $table->string('customer_ip_address')->nullable();
            $table->text('customer_user_agent')->nullable();
            $table->text('customer_note')->nullable();

            $table->json('billing')->nullable();
            $table->json('shipping')->nullable();

            $table->json('line_items')->nullable();
            $table->json('shipping_lines')->nullable();
            $table->json('coupon_lines')->nullable();
            $table->json('refunds')->nullable();
            $table->json('tax_lines')->nullable();
            $table->json('fee_lines')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
