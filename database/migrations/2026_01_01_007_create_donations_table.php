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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->constrained('donors')->onDelete('cascade');
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('set null');
            $table->foreignId('donation_fund_id')->nullable()->constrained('donation_funds')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('amount', 15, 2);
            $table->string('payment_method'); // sslcommerz, bKash, Nagad, Rocket, Card, Bank Transfer
            $table->string('transaction_id'); // Format: DA-2026-XXXXX
            $table->string('gateway_transaction_id')->nullable(); // Gateway's own transaction ID
            $table->enum('status', ['pending', 'initiated', 'processing', 'successful', 'failed', 'cancelled', 'refunded'])->default('pending');
            $table->text('message')->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
