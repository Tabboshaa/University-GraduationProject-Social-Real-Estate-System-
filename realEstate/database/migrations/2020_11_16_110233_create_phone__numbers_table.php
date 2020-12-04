<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhoneNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone__numbers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('User_ID')->references('User_ID')->on('users')->onDelete('cascade');
            $table->string('phone_number')->unique();
            $table->boolean('Default');
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
        Schema::dropIfExists('phone__numbers');
    }
}
