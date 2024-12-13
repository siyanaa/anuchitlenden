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
        Schema::create('loan_taking_loan_detail', function (Blueprint $table) {
            $table->id();
            $table->string('loan_purpose');
            $table->string('loan_date');
            $table->string('loan_location');
            $table->string('loan_amount');
            $table->string('loan_witness');
            $table->string('loan_docs_write');
            $table->string('loan_docs_address');
            $table->string('loan_medium');
            $table->boolean('is_loan_docs');
            $table->boolean('is_loan_same');
            $table->string('loan_tamasuk_amount');
            $table->string('loan_transaction_actual_amount');
            $table->boolean('is_taken_loan_stamp');
            $table->string('taken_loan_stamp_amount');
            $table->boolean('is_written_tamsuk_changed');
            $table->boolean('is_land_return_promise');
            $table->boolean('is_other_return_promise');
            $table->string('land_used_by_name')->nullable();
            $table->string('land_used_by_address')->nullable();
            $table->boolean('is_land_stop_promise');
            $table->string('land_stop_promise_state')->nullable();
            $table->string('land_stop_promise_used_by_name')->nullable();
            $table->string('land_stop_promise_used_by_address')->nullable();
            $table->boolean('is_witness_any_promise');
            $table->string('witness_any_promise_state')->nullable();
            $table->string('land_stop_promise_who_name');
            $table->string('land_rights_possessed_by_whome');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_taking_loan_detail');
    }
};
