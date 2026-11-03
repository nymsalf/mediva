<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('medical_record_id')->unique();
            $table->uuid('processed_by')->nullable();

            $table->foreign('medical_record_id')
                  ->references('id')
                  ->on('medical_records')
                  ->onDelete('cascade');

            $table->foreign('processed_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};