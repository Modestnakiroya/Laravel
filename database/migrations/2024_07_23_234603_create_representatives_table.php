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
        Schema::create('representatives', function (Blueprint $table) {
            $table->id('representativeId');
            $table->string('username');
            $table->string('emailAddress')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('school_registration_number');
            $table->timestamps();
            $table->string('password');
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
        Schema::dropIfExists('representatives');
    }
};