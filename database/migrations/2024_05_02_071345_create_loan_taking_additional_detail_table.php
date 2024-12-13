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
        Schema::create('loan_taking_additional_detail', function (Blueprint $table) {
            $table->id();
            $table->string('applicant_house_no');
            $table->string('applicant_house_area');
            $table->string('applicant_house_type');
            $table->string('applicant_house_storeyed');
            $table->string('applicant_house_state');
            $table->string('applicant_house_district');
            $table->string('applicant_house_local');
            $table->string('applicant_house_ward');
            $table->string('applicant_land_kitta_no');
            $table->string('applicant_land_area');
            $table->string('applicant_land_state');
            $table->string('applicant_land_district');
            $table->string('applicant_land_local');
            $table->string('applicant_land_ward');
            $table->string('applicant_vehicle_details');
            $table->string('applicant_current_asset_details');
            $table->string('applicant_org_name');
            $table->string('applicant_finance_org_branch');
            $table->string('applicant_account_opening_date');
            $table->string('applicant_finance_amount');
            $table->string('transaction_actual_interest')->nullable();
            $table->string('application_verifying_document')->nullable();
            $table->string('application_document_file')->nullable();
            $table->boolean('is_crime_reported')->nullable();
            $table->string('if_crime_reported')->nullable();
            $table->string('stamp_person_name')->nullable();
            $table->string('stamp_person_signature')->nullable();
            $table->string('stamp_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_taking_additional_detail');
    }
};
