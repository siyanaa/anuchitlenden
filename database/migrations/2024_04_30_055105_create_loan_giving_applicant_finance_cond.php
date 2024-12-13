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
        Schema::create('loan_giving_applicant_finance_cond', function (Blueprint $table) {
            $table->id();
            $table->string('home_no');
            $table->string('home_area');
            $table->string('home_type');
            $table->string('home_storey');
            $table->string('home_state');
            $table->string('home_district');
            $table->string('home_local');
            $table->string('home_ward');
            $table->string('land_kitta');
            $table->string('land_area');
            $table->string('land_state');
            $table->string('land_district');
            $table->string('land_local');
            $table->string('land_ward');
            $table->text('vehicle_description');
            $table->text('vehicle_count');
            $table->text('amount_asset_description');
            $table->text('amount_asset_count');
            $table->string('finance_name')->nullable();
            $table->string('finance_branch')->nullable();
            $table->string('finance_accountissue_date')->nullable();
            $table->string('finance_data')->nullable();
            $table->string('loan_finance_name')->nullable();
            $table->string('loan_finance_branch')->nullable();
            $table->string('loan_finance_liability')->nullable();
            $table->string('loan_finance_remainingpay')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_giving_applicant_finance_cond');
    }
};
