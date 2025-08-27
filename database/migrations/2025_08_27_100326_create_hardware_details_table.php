<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hardware_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('asset_tag')->unique();
            $table->string('serial_number')->unique()->nullable();
            $table->foreignUuid('model_id')->constrained('asset_models');
            $table->timestamp('warranty_expires_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hardware_details');
    }
};
