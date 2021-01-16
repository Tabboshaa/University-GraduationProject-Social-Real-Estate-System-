<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id('Country_Id');
            $table->string('Country_Name')->unique();
            $table->timestamps();
        });
        Schema::create('states', function (Blueprint $table) {
            $table->id('State_Id');
            $table->foreignId('Country_Id')->references('Country_Id')->on('countries')->onDelete('cascade');
            $table->string('State_Name')->unique();
            $table->timestamps();
        });
        Schema::create('cities', function (Blueprint $table) {
            $table->id('City_Id');
            $table->foreignId('Country_Id')->references('Country_Id')->on('states')->onDelete('cascade');
            $table->foreignId('State_Id')->references('State_Id')->on('states')->onDelete('cascade');
            $table->string('City_Name')->unique();
            $table->timestamps();
        });
        Schema::create('regions', function (Blueprint $table) {
            $table->id('Region_Id');
            $table->foreignId('Country_Id')->references('Country_Id')->on('cities')->onDelete('cascade');
            $table->foreignId('State_Id')->references('State_Id')->on('cities')->onDelete('cascade');
            $table->foreignId('City_Id')->references('City_Id')->on('cities')->onDelete('cascade');
            $table->string('Region_Name');
            $table->timestamps();
        });
        Schema::create('streets', function (Blueprint $table) {
            $table->id('Street_Id');
            $table->foreignId('Country_Id')->references('Country_Id')->on('regions')->onDelete('cascade');
            $table->foreignId('State_Id')->references('State_Id')->on('regions')->onDelete('cascade');
            $table->foreignId('City_Id')->references('City_Id')->on('regions')->onDelete('cascade');
            $table->foreignId('Region_Id')->references('Region_Id')->on('regions')->onDelete('cascade');
            $table->string('Street_Name');
            $table->timestamps();
        });
        Schema::create('items', function (Blueprint $table) {
            $table->id('Item_Id');
            $table->foreignId('Street_Id')->references('Street_Id')->on('streets')->onDelete('cascade')->nullable();
            $table->foreignId('User_Id')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->string('Item_Name');
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
        Schema::dropIfExists('items');
    }
}
