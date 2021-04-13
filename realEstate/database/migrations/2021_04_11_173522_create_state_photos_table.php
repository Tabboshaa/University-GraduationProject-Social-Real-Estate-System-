<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('state_photos', function (Blueprint $table) {
            $table->id('photo_id');
            $table->foreignId('Attachment_Id')->references('Attachment_Id')->on('attachments')->onDelete('cascade');
            $table->foreignId('State_Id')->references('State_Id')->on('cities')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * 
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('state_photos');
    }
}
