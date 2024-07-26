<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attempt_questions', function (Blueprint $table) {
            $table->id('attemptId');
            $table->string('username');
            $table->string('challengeNo');
            $table->string('questionAttempted');
            $table->string('school_registration_number');
            $table->timestamps();
            $table->foreign('challengeNo')->references('challengeNo')->on('challenges')->onDelete('cascade');
            $table->foreign('school_registration_number')->references('school_registration_number')->on('schools')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attempt_questions');
    }
};
