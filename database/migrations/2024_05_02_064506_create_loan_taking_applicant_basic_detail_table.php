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
        Schema::create('loan_taking_applicant_basic_detail', function (Blueprint $table) {
            $table->id();
            $table->string('applicant_name');
            $table->string('applicant_age')->nullable();
            $table->string('applicant_citizenship')->nullable();
            $table->string('applicant_citizenship_issue_district')->nullable();
            $table->string('applicant_citizenship_issue_date')->nullable();
            $table->string('applicant_fathername');
            $table->string('applicant_fathers_no');
            $table->string('applicant_spouse')->nullable();
            $table->string('applicant_spouse_no')->nullable();
            $table->string('applicant_family');
            $table->string('applicant_annual_income');
            $table->string('applicant_permanent_state');
            $table->string('applicant_permanent_district');
            $table->string('applicant_permanent_local');
            $table->string('applicant_permanent_ward');
            $table->string('applicant_temp_state');
            $table->string('applicant_temp_district');
            $table->string('applicant_temp_local');
            $table->string('applicant_temp_ward');
            $table->string('applicant_pan')->nullable();
            $table->string('applicant_occup')->nullable();
            $table->string('applicant_edu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_taking_applicant_basic_detail');
    }
};
