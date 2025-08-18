<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique()->nullable();
            $table->foreignUuid('position_id')->nullable()->constrained('positions')->onDelete('set null');
            $table->foreignUuid('section_id')->nullable()->constrained('sections')->onDelete('set null');
            $table->foreignUuid('role_id')->nullable()->constrained('roles')->onDelete('set null');
            $table->string('password');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
            $table->rememberToken();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
