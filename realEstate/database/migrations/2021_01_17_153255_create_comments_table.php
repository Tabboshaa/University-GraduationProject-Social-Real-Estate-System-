<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id('Comment_Id');
            $table->foreignId('Post_Id')->references('Post_Id')->on('posts')->onDelete('cascade');
            $table->foreignId('User_Id')->references('id')->on('users')->onDelete('cascade');   
            $table->foreignId('Attachment_Id')->references('Attachment_Id')->on('attachments')->onDelete('cascade');
            $table->string('Comment');
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
        Schema::dropIfExists('comments');
    }
}
