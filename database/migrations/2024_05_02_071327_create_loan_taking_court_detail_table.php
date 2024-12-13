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
        Schema::create('loan_taking_court_detail', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_issue_in_court');
            $table->string('issue_in_court_result')->nullable();
            $table->string('issue_in_court_subject')->nullable();
            $table->string('issue_in_court_subject_no')->nullable();
            $table->boolean('is_issue_in_court_applicant_asset_collapse')->nullable();
            $table->string('applicant_collapse_by_who_name')->nullable();
            $table->string('applicant_collapse_by_who_address')->nullable();
            $table->boolean('is_application_decision_jailtime')->nullable();
            $table->boolean('is_jail_subjected')->nullable();
            $table->string('if_in_jail_start_date')->nullable();
            $table->string('if_in_jail_start_duration')->nullable();
            $table->boolean('is_cheque_bounce_case');
            $table->string('cheque_bounce_case_result')->nullable();
            $table->string('case_result_bigo')->nullable();
            $table->string('case_result_fine')->nullable();
            $table->string('case_result_jail')->nullable();
            $table->string('if_bank_cheque_case_resulted')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_taking_court_detail');
    }
};
