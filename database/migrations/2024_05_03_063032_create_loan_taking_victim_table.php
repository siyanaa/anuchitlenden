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
        Schema::create('loan_taking_victim', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('registration_id');
            $table->foreign('registration_id')->references('id')->on('loan_taking_application_registration')->onDelete('cascade');

            $table->unsignedBigInteger('basic_detail_id');
            $table->foreign('basic_detail_id')->references('id')->on('loan_taking_applicant_basic_detail')->onDelete('cascade');

            $table->unsignedBigInteger('opponent_detail_id');
            $table->foreign('opponent_detail_id')->references('id')->on('loan_taking_opponent_detail')->onDelete('cascade');

            $table->unsignedBigInteger('loan_detail_id');
            $table->foreign('loan_detail_id')->references('id')->on('loan_taking_loan_detail')->onDelete('cascade');

            $table->unsignedBigInteger('interest_detail_id');
            $table->foreign('interest_detail_id')->references('id')->on('loan_taking_interest_detail')->onDelete('cascade');

            $table->unsignedBigInteger('court_detail_id');
            $table->foreign('court_detail_id')->references('id')->on('loan_taking_court_detail')->onDelete('cascade');

            $table->unsignedBigInteger('additional_detail_id');
            $table->foreign('additional_detail_id')->references('id')->on('loan_taking_additional_detail')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_taking_victim');
    }
};
