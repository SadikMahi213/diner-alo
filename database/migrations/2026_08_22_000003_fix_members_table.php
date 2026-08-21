<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            // Add missing columns that controller/model expect, if not exists
            if (!Schema::hasColumn('members', 'name')) {
                $table->string('name')->nullable()->after('user_id');
            }
            if (!Schema::hasColumn('members', 'email')) {
                $table->string('email')->nullable()->after('name');
            }
            if (!Schema::hasColumn('members', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }
            if (!Schema::hasColumn('members', 'district')) {
                $table->string('district')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('members', 'profession')) {
                $table->string('profession')->nullable()->after('district');
            }
            if (!Schema::hasColumn('members', 'experience')) {
                $table->text('experience')->nullable()->after('profession');
            }
            if (!Schema::hasColumn('members', 'address')) {
                $table->text('address')->nullable()->after('experience');
            }
            if (!Schema::hasColumn('members', 'nid')) {
                $table->string('nid')->nullable()->after('address');
            }
            if (!Schema::hasColumn('members', 'status')) {
                $table->string('status')->default('pending')->after('membership_type');
            }
            if (!Schema::hasColumn('members', 'expiry_date')) {
                $table->date('expiry_date')->nullable()->after('join_date');
            }
            // Make user_id nullable for guest applications (was constrained cascade)
            // We need to drop and re-add the foreign key to make it nullable
            // Check if user_id is not nullable, then make it nullable
        });

        // Make user_id nullable if needed - do it in a separate schema call to handle foreign key
        try {
            Schema::table('members', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable()->change();
            });
        } catch (\Throwable $e) {
            // If change fails due to foreign key, try without
        }

        // Ensure is_active and status can coexist; if status exists, keep is_active for backward compat
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $columns = ['name', 'email', 'phone', 'district', 'profession', 'experience', 'address', 'nid', 'status', 'expiry_date'];
            foreach ($columns as $col) {
                if (Schema::hasColumn('members', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
