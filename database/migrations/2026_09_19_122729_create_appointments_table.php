<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('patient_id');
            $table->uuid('doctor_id');

            $table->integer('queue_number');
            $table->string('status');
            $table->date('visit_date');

            $table->foreign('patient_id')
                  ->references('id')
                  ->on('patients')
                  ->onDelete('cascade');

            $table->foreign('doctor_id')
                  ->references('id')
                  ->on('doctors')
                  ->onDelete('restrict');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};