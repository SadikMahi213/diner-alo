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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('set null');
            $table->string('title');
            $table->text('description');
            $table->string('cover_image')->nullable();
            $table->string('gallery')->default('[]');
            $table->decimal('target_amount', 15, 2);
            $table->decimal('collected_amount', 15, 2)->default(0);
            $table->integer('beneficiary_count')->default(0);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('location');
            $table->enum('status', ['upcoming', 'running', 'completed'])->default('upcoming');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};