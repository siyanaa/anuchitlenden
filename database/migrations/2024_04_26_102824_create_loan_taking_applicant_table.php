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
        Schema::create('loan_taking_applicant', function (Blueprint $table) {
            $table->id();
            $table->string('applicant_name');
            $table->integer('applicant_age');
            $table->bigInteger('applicant_citizenship_no');
            $table->string('applicant_issue_date');
            $table->string('applicant_father_name');
            $table->bigInteger('applicant_father_phone');
            $table->string('applicant_spouse_name');
            $table->bigInteger('applicant_spouse_phone');
            $table->integer('applicant_family_member_no');
            $table->string('applicant_annual_income');
            $table->string('applicant_permanent_state');
            $table->string('applicant_permanent_district');
            $table->string('applicant_permanent_location');
            $table->string('applicant_permanent_ward');
            $table->string('applicant_temp_state');
            $table->string('applicant_temp_district');
            $table->string('applicant_temp_local');
            $table->string('applicant_temp_ward');
            $table->bigInteger('pan_no');
            $table->string('applicant_occupation');
            $table->string('applicant_education_level');
            $table->string('opponent_name');
            $table->integer('opponent_age');
            $table->string('opponent_father_name');
            $table->bigInteger('opponent_father_phone');
            $table->string('opponent_spouse_name');
            $table->bigInteger('opponent_spouse_phone');
            $table->string('opponent_permanent_state');
            $table->string('opponent_permanent_district');
            $table->string('opponent_permanent_location');
            $table->string('opponent_permanent_ward');
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_taking_applicant');
    }
};
