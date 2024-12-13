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
        Schema::create('releases', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('registration_id');
            $table->foreign('registration_id')->references('id')->on('registrations')->onUpdate('cascade')->onDelete('cascade');
            
            $table->unsignedBigInteger('no_transaction_purpose_id')->nullable()->comment('reason_to_no_transaction, this is if only no transaction is selected');
            $table->foreign('no_transaction_purpose_id')->references('id')->on('no_transaction_purposes')->onUpdate('cascade');
            
            $table->date('release_agreement_date')->nullable();
            $table->boolean('issue_in_court')->default(0)->comment('0=>no, 1=>yes');//
            $table->boolean('release_criteria')->default(0)->comment('0=>no transaction, 1=>transaction');//
            $table->boolean('agreement_applied_status')->default(1)->comment('0=>due date applied, 1=>instant');
            $table->date('applied_due_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('releases');
    }
};
