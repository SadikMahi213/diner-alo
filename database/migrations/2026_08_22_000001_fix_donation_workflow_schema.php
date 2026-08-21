<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Fix donors.user_id to be nullable for guest donations
        Schema::table('donors', function (Blueprint $table) {
            // Drop foreign key first if exists
            try {
                $table->dropForeign(['user_id']);
            } catch (\Throwable $e) {
                // ignore if not exists
            }
        });
        Schema::table('donors', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
        Schema::table('donors', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });

        // Add is_active to donation_funds to match reference API (isActive)
        Schema::table('donation_funds', function (Blueprint $table) {
            if (!Schema::hasColumn('donation_funds', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('suggested_amounts');
            }
            if (!Schema::hasColumn('donation_funds', 'slug')) {
                $table->string('slug')->nullable()->after('name_en');
            }
        });

        // Ensure unique index on transaction_id for safety
        Schema::table('donations', function (Blueprint $table) {
            if (!Schema::hasColumn('donations', 'currency')) {
                $table->string('currency')->default('BDT')->after('amount');
            }
        });

        try {
            Schema::table('donations', function (Blueprint $table) {
                $table->unique('transaction_id');
            });
        } catch (\Throwable $e) {
            // already exists or duplicate data
        }

        try {
            Schema::table('transactions', function (Blueprint $table) {
                $table->unique('transaction_id');
            });
        } catch (\Throwable $e) {
        }
    }

    public function down(): void
    {
        Schema::table('donation_funds', function (Blueprint $table) {
            if (Schema::hasColumn('donation_funds', 'is_active')) {
                $table->dropColumn('is_active');
            }
            if (Schema::hasColumn('donation_funds', 'slug')) {
                $table->dropColumn('slug');
            }
        });
    }
};
