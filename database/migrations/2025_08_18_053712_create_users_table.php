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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->uuid('position')->nullable();
            $table->uuid('section')->nullable();
            $table->string('username')->unique();
            $table->string('role')->nullable();
            $table->string('password');
            $table->string('token');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
            $table->rememberToken();

            $table->foreign('position')->references('id')->on('positions')->onDelete('cascade');
            $table->foreign('section')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('role')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
