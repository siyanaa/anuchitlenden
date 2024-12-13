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
        Schema::create('loan_taking_opponent_detail', function (Blueprint $table) {
            $table->id();
            $table->string('opponent_name');
            $table->string('opponent_age')->nullable();
            $table->string('opponent_fathername')->nullable();
            $table->string('opponent_fathers_no')->nullable();
            $table->string('opponent_spouse')->nullable();
            $table->string('opponent_spouse_no')->nullable();
            $table->string('opponent_permanent_state')->nullable();
            $table->string('opponent_permanent_district')->nullable();
            $table->string('opponent_permanent_local')->nullable();
            $table->string('opponent_permanent_ward')->nullable();
            $table->string('opponent_temp_state')->nullable();
            $table->string('opponent_temp_district')->nullable();
            $table->string('opponent_temp_local')->nullable();
            $table->string('opponent_temp_ward')->nullable();
            $table->string('opponent_occupation')->nullable();
            $table->string('opponent_education_level')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_taking_opponent_detail');
    }
};
