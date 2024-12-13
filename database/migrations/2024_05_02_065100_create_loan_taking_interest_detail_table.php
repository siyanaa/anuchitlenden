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
        Schema::create('loan_taking_interest_detail', function (Blueprint $table) {
            $table->id();
            $table->string('written_docs_interest_rate');
            $table->string('written_docs_given_interest_rate');
            $table->string('till_now_interest_amount');
            $table->string('interest_paid_medium');
            $table->string('till_now_paid_capital');
            $table->string('till_now_to_be_paid_amount');
            $table->boolean('is_registered_inward');
            $table->boolean('registered_no')->nullable();
            $table->string('loan_amount_pay_last_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_taking_interest_detail');
    }
};
