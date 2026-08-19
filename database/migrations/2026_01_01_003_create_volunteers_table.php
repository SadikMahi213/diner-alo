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
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('district');
            $table->string('profession');
            $table->text('skills')->nullable();
            $table->enum('availability', ['weekends', 'weekdays', 'flexible', 'full_time']);
            $table->enum('preferred_activity', ['education', 'medical', 'food', 'relief', 'events', 'administrative', 'other']);
            $table->text('experience')->nullable();
            $table->string('profile_photo')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'inactive'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteers');
    }
};