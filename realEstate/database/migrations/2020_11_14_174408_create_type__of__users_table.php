<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeOfUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type__of__users', function (Blueprint $table) {
            $table->foreignId('User_ID')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('User_Type_ID')->references('User_Type_ID')->on('user__types')->onDelete('cascade');
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
        Schema::dropIfExists('type__of__users');
    }
}
