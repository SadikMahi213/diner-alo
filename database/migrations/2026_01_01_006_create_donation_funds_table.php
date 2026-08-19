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
        Schema::create('donation_funds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('project_categories')->onDelete('set null');
            $table->string('name_bn');
            $table->string('name_en');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->decimal('minimum_amount', 10, 2)->default(100);
            $table->decimal('suggested_amounts')->default('0'); // JSON string
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_funds');
    }
};