<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('User_Id');
            $table->string('Image')->nullable();
            $table->string('First_Name');
            $table->string('Middle_Name');
            $table->string('Last_Name');
            $table->date('Birth_Day');
            $table->string('Gender');
            $table->string('password');
            $table->string('National_ID');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
