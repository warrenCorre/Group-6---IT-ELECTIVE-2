<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Only add columns if they don't already exist
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('member');
            }
            if (!Schema::hasColumn('users', 'age')) {
                $table->integer('age')->nullable();
            }
            if (!Schema::hasColumn('users', 'bio')) {
                $table->text('bio')->nullable();
            }
            if (!Schema::hasColumn('users', 'profile_photo')) {
                $table->string('profile_photo')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'age', 'bio', 'profile_photo']);
        });
    }
};