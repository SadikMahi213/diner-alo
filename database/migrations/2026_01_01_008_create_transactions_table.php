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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donation_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('order_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('gateway_name'); // sslcommerz, bkash, nagad, rocket, card, bank_transfer, manual
            $table->string('gateway')->default('manual'); // Primary gateway identifier
            $table->string('gateway_transaction_id')->nullable(); // Gateway's own transaction ID (e.g., bank_tran_id)
            $table->string('gateway_session_id')->nullable(); // SSLCommerz tran_id for this session
            $table->longText('gateway_response')->nullable(); // Raw response from gateway (JSON)
            $table->string('status')->default('pending'); // pending, initiated, processing, successful, failed, cancelled, refunded
            $table->string('transaction_id'); // Internal unique ID like DA-2026-000001 or ORD-2026-000001
            $table->decimal('amount', 15, 2);
            $table->string('currency')->default('BDT');
            $table->string('type')->default('credit'); // credit, debit
            $table->text('description')->nullable();
            $table->text('failure_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
