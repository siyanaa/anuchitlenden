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
        Schema::create('count_data', function (Blueprint $table) {
            $table->id();
            $table->string('registration_count')->nullable();
            $table->string('discussions_count')->nullable();
            $table->string('no_agreement_discussions_count')->nullable();
            $table->string('releases_count')->nullable();
            $table->integer('register_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('count_data');
    }
};
