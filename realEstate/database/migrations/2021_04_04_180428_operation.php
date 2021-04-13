<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Operation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id('Operation_Id');
            $table->foreignId('Item_Id')->references('Item_Id')->on('items')->onDelete('cascade');
            $table->foreignId('User_Id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('operation__types', function (Blueprint $table) {
            $table->id('Operation_Type_Id');
            $table->string('Operation_Name')->unique();
            $table->timestamps();
        });
        Schema::create('operation__detail_name', function (Blueprint $table) {
            $table->id('Detail_Id');
            $table->foreignId('Operation_Type_Id')->references('Operation_Type_Id')->on('operation__types')->onDelete('cascade');
            $table->string('Operation_Detail_Name');
            $table->timestamps();
        });
        Schema::create('operation__detail_value', function (Blueprint $table) {
            $table->id('Value_Id');
            $table->foreignId('Operation_Id')->references('Operation_Id')->on('operations')->onDelete('cascade');
            $table->foreignId('Operation_Type_Id')->references('Operation_Type_Id')->on('operation__types')->onDelete('cascade');
            $table->foreignId('Detail_Id')->references('Detail_Id')->on('operation__detail_name')->onDelete('cascade');
            $table->string('Operation_Detail_Value');
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
        //
    }
}
