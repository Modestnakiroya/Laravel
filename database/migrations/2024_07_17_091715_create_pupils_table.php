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
        Schema::create('pupils', function (Blueprint $table) {
            $table->id('username');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('emailAddress')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->date('dateOfBirth');
            $table->string('password');
            $table->string('school_registration_number');
            $table->timestamps();
            $table->foreign('school_registration_number')->references('registration_number')->on('schools')->onDelete('cascade');


            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pupils');
    }
};
