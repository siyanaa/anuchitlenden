<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('loan_giving_victims', function (Blueprint $table) {
            $table->id();


            $table->integer('register_by');
            $table->index('register_by');

            $table->unsignedBigInteger('registration_id');
            $table->foreign('registration_id')->references('id')->on('loan_giving_application_registration')->onDelete('cascade');

            $table->unsignedBigInteger('basic_detail_id');
            $table->foreign('basic_detail_id')->references('id')->on('loan_giving_applicant_basic_detail')->onDelete('cascade');

            $table->unsignedBigInteger('applicant_finance_cond_id');
            $table->foreign('applicant_finance_cond_id')->references('id')->on('loan_giving_applicant_finance_cond')->onDelete('cascade');

            $table->unsignedBigInteger('debtor_application_detail_id');
            $table->foreign('debtor_application_detail_id')->references('id')->on('loan_giving_debtor_application_detail')->onDelete('cascade');

            $table->unsignedBigInteger('transaction_application_detail_id');
            $table->foreign('transaction_application_detail_id')->references('id')->on('loan_giving_transaction_application_detail')->onDelete('cascade');

            $table->unsignedBigInteger('other_detail_id');
            $table->foreign('other_detail_id')->references('id')->on('loan_giving_application_other_details')->onDelete('cascade');
            // $table->timestamps();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loan_giving_victims', function (Blueprint $table) {
            $table->dropForeign(['registration_id']);
            $table->dropColumn(['registration_id']);
            $table->dropForeign(['applicant_finance_cond_id']);
            $table->dropColumn(['applicant_finance_cond_id']);
        });
        Schema::dropIfExists('loan_giving_victims');
    }
};
