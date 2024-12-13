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
        Schema::create('offenders', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('registration_id');
            $table->foreign('registration_id')->references('id')->on('registrations')->onDelete('cascade');
            
            $table->string('full_name');
            $table->string('contact')->nullable();

            $table->integer('state_id');
            $table->index('state_id');
            
            $table->integer('district_id');
            $table->index('district_id');

            $table->integer('localbody_id')->nullable();
            $table->index('localbody_id');

            $table->integer('wada_id')->nullable();
            $table->index('wada_id');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offenders');
    }
};
