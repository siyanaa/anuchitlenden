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
        Schema::create('loan_giving_debtor_application_detail', function (Blueprint $table) {
            $table->id();
            $table->string('debtor_name');

           // $table->string('debtor_state')->nullable();
        // $table->string('debtor_district')->nullable();
            $table->string('debtor_local');
        // $table->string('debtor_ward')->nullable();

            $table->string('debit_date');
            $table->string('debit_amount');
            $table->string('debit_medium');
            $table->string('other_debtors_no');
            $table->string('other_debtors_amount');
            $table->boolean('is_statement_register');
            $table->string('statement_register_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_giving_debtor_application_detail');
    }
};
