<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->foreignUuid('status_id')->constrained('asset_statuses');
            $table->foreignUuid('assigned_to_user_id')->nullable()->constrained('users');
            $table->foreignUuid('location_id')->nullable()->constrained('asset_locations');
            $table->date('purchase_date')->nullable();
            $table->text('notes')->nullable();
            $table->uuid('assetable_id');
            $table->string('assetable_type');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
