<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('registration_id', 500);

            $table->integer('register_by');
            $table->index('register_by');
            
            $table->string('transaction_amount')->nullable();
            $table->dateTime('tansaction_date')->nullable();
            
            $table->integer('is_active')->comment('0=>active still the issue is not resolved, 1=>issue disclosed')->default(0);
            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}
