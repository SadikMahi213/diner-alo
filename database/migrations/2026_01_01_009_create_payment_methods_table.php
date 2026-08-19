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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // bKash, Nagad, Rocket, Card, Bank Transfer
            $table->string('code'); // Short code
            $table->string('provider_api')->nullable(); // API class name
            $table->string('endpoint')->nullable(); // Callback endpoint
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0); // Display order
            $table->timestamps();
        });

        // Insert default payment methods
        \Illuminate\Support\Facades\DB::table('payment_methods')->insert([
            ['name' => 'SSLCommerz', 'code' => 'sslcommerz', 'provider_api' => 'SslCommerzGateway', 'is_active' => true, 'order' => 0],
            ['name' => 'bKash', 'code' => 'bkash', 'provider_api' => 'BkashGateway', 'is_active' => true, 'order' => 1],
            ['name' => 'Nagad', 'code' => 'nagad', 'provider_api' => 'NagadGateway', 'is_active' => true, 'order' => 2],
            ['name' => 'Rocket', 'code' => 'rocket', 'provider_api' => 'RocketGateway', 'is_active' => true, 'order' => 3],
            ['name' => 'Card', 'code' => 'card', 'provider_api' => 'CardGateway', 'is_active' => true, 'order' => 4],
            ['name' => 'Bank Transfer', 'code' => 'bank', 'provider_api' => 'BankTransferGateway', 'is_active' => true, 'order' => 5],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};