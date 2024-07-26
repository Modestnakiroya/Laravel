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
        Schema::create('accepted_pupils', function (Blueprint $table) {
            $table->id(username);
            $table->string(firstName);
            $table->string(lastName);
            $table->string(emailAddress);
            $table->date(dateOfBirth);
            $table->string(school_registration_number);
            $table->string(password);
            $table->timestamps();
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
        Schema::dropIfExists('accepted_pupils');
    }
};
