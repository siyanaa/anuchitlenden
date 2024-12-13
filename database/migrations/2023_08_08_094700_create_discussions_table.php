<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscussionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('registration_id');
            $table->date('discussion_date')->nullable();
            $table->date('previous_date')->nullable();
            $table->string('offender_demand_reveal');
            $table->bigInteger('offender_demand')->nullable();
            $table->integer('applicant_willing_to_pay')->nullable();
            $table->text('reason_to_disagreement')->nullable();
            $table->timestamps();

            $table->foreign('registration_id')->references('id')->on('registrations');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discussions');
    }
}
