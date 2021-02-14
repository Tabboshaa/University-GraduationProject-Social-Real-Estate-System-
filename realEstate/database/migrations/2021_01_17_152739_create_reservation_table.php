<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation', function (Blueprint $table) {
            $table->id('reservation_Id');
            $table->foreignId('Item_Id')->references('Item_Id')->on('items')->onDelete('cascade');
            $table->foreignId('User_Id')->references('id')->on('users')->onDelete('cascade');  
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
        Schema::dropIfExists('reservation');
    }
}
