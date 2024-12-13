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
        Schema::create('loan_giving_application_other_details', function (Blueprint $table) {
            $table->id();
            $table->string('loan_landrestrict_owner');
            $table->string('loan_taking_person_name');
            $table->string('land_passed_name');
            $table->string('registered_person_relation');
            $table->string('landrestrict_kitta')->nullable();
            $table->string('landrestrict_area')->nullable();
            $table->string('landrestrict_state')->nullable();
            $table->string('landrestrict_district')->nullable();
            $table->string('landrestrict_local')->nullable();
            $table->string('landrestrict_ward')->nullable();
            $table->string('landrestrict_registration_date')->nullable();

            $table->boolean('is_loan_cheque_shown');
            $table->string('cheque_giving_person')->nullable();
            $table->string('cheque_receiving_person')->nullable();
            $table->string('cheque_issue_date')->nullable();
            $table->string('cheque_bounce_date')->nullable();
            $table->string('cheque_detail_amount')->nullable();
            $table->text('cheque_other_details')->nullable();

            $table->boolean('is_court_case_pending');
            $table->string('court_case_state_name')->nullable();
            $table->string('court_case_subject')->nullable();;
            // $table->string('court_case_no')->nullable();;
            $table->boolean('is_amount_short_person_injail')->nullable();

            $table->boolean('is_court_case_done')->nullable();

            $table->string('landrestricted_usedby_now')->nullable();

            $table->boolean('is_when_registered_otherdocs');
            $table->text('when_registered_othercondition_name')->nullable();
            $table->text('other_details_in_transaction')->nullable();

            $table->string('application_attached_documents')->nullable();
            $table->string('application_document_file')->nullable();
            $table->string('stamped_name')->nullable();
            $table->string('stamped_date')->nullable();
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_giving_application_other_details');
    }
};

