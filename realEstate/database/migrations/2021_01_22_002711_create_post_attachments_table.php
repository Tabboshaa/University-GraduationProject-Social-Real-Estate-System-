<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Post_Id')->references('Post_Id')->on('posts')->onDelete('cascade')->nullable();;
            $table->foreignId('Attachment_Id')->references('Attachment_Id')->on('attachments')->onDelete('cascade');
            $table->foreignId('Item_Id')->references('Item_Id')->on('items')->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('post_attachments');
    }
}
