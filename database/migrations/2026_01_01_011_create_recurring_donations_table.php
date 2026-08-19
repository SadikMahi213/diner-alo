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
        Schema::create('recurring_donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->constrained('donors')->onDelete('cascade');
            $table->foreignId('donation_fund_id')->constrained('donation_funds')->onDelete('set null');
            $table->foreignId('user_id')->constrained()->onDelete('set null');
            $table->decimal('amount', 15, 2);
            $table->enum('frequency', ['monthly', 'quarterly', 'yearly']);
            $table->string('payment_method'); // bKash, Nagad, Rocket, Card
            $table->string('transaction_id')->nullable();
            $table->enum('status', ['active', 'paused', 'cancelled', 'failed'])->default('active');
            $table->date('next_payment_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recurring_donations');
    }
};