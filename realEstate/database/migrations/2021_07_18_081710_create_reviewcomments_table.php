<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewcommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviewcomments', function (Blueprint $table) {
            $table->id('Comment_Id');
            $table->foreignId('Post_Id')->references('Review_Id')->on('reviews')->onDelete('cascade');
            $table->foreignId('User_Id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('Attachment_Id')->references('Attachment_Id')->on('attachments')->onDelete('cascade');
            $table->string('Comment');
            $table->integer('Parent_Comment');
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
        Schema::dropIfExists('reviewcomments');
    }
}
