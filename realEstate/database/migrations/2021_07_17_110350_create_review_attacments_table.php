<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewAttacmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_attacments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Review_Id')->references('Review_Id')->on('reviews')->onDelete('cascade');
            $table->foreignId('Item_Id')->references('Item_Id')->on('items')->onDelete('cascade')->nullable();
            $table->string('path');
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
        Schema::dropIfExists('review_attacments');
    }
}
