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
        Schema::create('applicant_received_on_releases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('registration_id');
            $table->unsignedBigInteger('release_id');
            
            $table->unsignedBigInteger('nature_id');
            $table->string('amount')->nullable();
            $table->string('kitta')->nullable();
            $table->foreign('registration_id')->references('id')->on('registrations');
            $table->foreign('release_id')->references('id')->on('releases')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('nature_id')->references('id')->on('natures');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_received_on_releases');
    }
};
