<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prescription_details', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('prescription_id');
            $table->uuid('medicine_id');

            $table->integer('quantity');

            $table->foreign('prescription_id')
                  ->references('id')
                  ->on('prescriptions')
                  ->onDelete('cascade');

            $table->foreign('medicine_id')
                  ->references('id')
                  ->on('medicines')
                  ->onDelete('restrict');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prescription_details');
    }
};