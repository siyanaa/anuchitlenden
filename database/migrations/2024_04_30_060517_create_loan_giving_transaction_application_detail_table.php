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
        Schema::create('loan_giving_transaction_application_detail', function (Blueprint $table) {
            $table->id();
            $table->string('trans_medium');
            $table->string('trans_amount');
            $table->string('trans_capital_medium');
            $table->string('trans_capital_amount');
            $table->string('comp_amt_rem_prin');
            $table->string('comp_amt_rem_interest');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_giving_transaction_application_detail');
    }
};
