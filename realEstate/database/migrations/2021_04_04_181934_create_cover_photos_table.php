<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoverPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cover_photos', function (Blueprint $table) {
            $table->id('Photo_Id');
            $table->foreignId('User_Id')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->foreignId('Cover_Photo')->references('Attachment_Id')->on('attachments')->onDelete('cascade');
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
        Schema::dropIfExists('cover_photos');
    }
}
