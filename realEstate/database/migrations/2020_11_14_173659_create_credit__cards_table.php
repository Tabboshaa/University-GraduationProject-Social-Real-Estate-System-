<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit__cards', function (Blueprint $table) {
            $table->id();
            $table->string('Credit_Card_Id');
            $table->foreignId('User_ID')->references('User_ID')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('credit__cards');
    }
}
