<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('software_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('license_key')->nullable();
            $table->integer('total_seats')->default(1);
            $table->date('expiry_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('software_details');
    }
};
