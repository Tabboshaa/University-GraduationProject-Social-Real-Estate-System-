<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datatypes', function (Blueprint $table) {
            $table->id();
            $table->string('datatype');
            $table->timestamps();
        });
        Schema::create('main__types', function (Blueprint $table){
            $table->id('Main_Type_Id');
            $table->string('Main_Type_Name')->unique();
            $table->timestamps();
        });
        Schema::create('sub__types', function (Blueprint $table) {
            $table->id('Sub_Type_Id');
            $table->foreignId('Main_Type_Id')->references('Main_Type_Id')->on('main__types')->onDelete('cascade');
            $table->string('Sub_Type_Name')->unique();
            $table->timestamps();
        });
        Schema::create('sub__type__properties', function (Blueprint $table) {
            $table->id('Property_Id');
            $table->foreignId('Main_Type_Id')->references('Main_Type_Id')->on('sub__types')->onDelete('cascade');
            $table->foreignId('Sub_Type_Id')->references('Sub_Type_Id')->on('sub__types')->onDelete('cascade');
            $table->string('Property_Name');

            $table->timestamps();
        });
        Schema::create('property__details', function (Blueprint $table) {
            $table->id('Property_Detail_Id');
            $table->foreignId('Main_Type_Id')->references('Main_Type_Id')->on('sub__type__properties')->onDelete('cascade');
            $table->foreignId('Sub_Type_Id')->references('Sub_Type_Id')->on('sub__type__properties')->onDelete('cascade');
            $table->foreignId('Property_Id')->references('Property_Id')->on('sub__type__properties')->onDelete('cascade');
            $table->foreignId('DataType_Id')->references('id')->on('datatypes')->onDelete('cascade');
            $table->string('Detail_Name');
            $table->timestamps();
        });
        Schema::create('details', function (Blueprint $table) {
            $table->id('Detail_Id');
            $table->foreignId('Item_Id')->references('Item_Id')->on('items')->onDelete('cascade');
            $table->foreignId('Main_Type_Id')->references('Main_Type_Id')->on('property__details')->onDelete('cascade');
            $table->foreignId('Sub_Type_Id')->references('Sub_Type_Id')->on('property__details')->onDelete('cascade');
            $table->foreignId('Property_Id')->references('Property_Id')->on('property__details')->onDelete('cascade');
            $table->foreignId('Property_Detail_Id')->references('Property_Detail_Id')->on('property__details')->onDelete('cascade');
            $table->string('DetailValue');

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
        Schema::dropIfExists('details');
    }
}
