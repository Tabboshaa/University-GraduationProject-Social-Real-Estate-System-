<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id('Post_Id');
            $table->foreignId('Item_Id')->references('Item_Id')->on('items')->onDelete('cascade');
            $table->foreignId('User_Id')->references('id')->on('users')->onDelete('cascade');
            $table->string('Post_Title');
            $table->string('Post_Content');
            $table->timestamps();
        });
    //     Schema::create('post__types', function (Blueprint $table) {
    //         $table->id('Post_Type_Id');
    //         $table->foreignId('Post_Id')->references('Post_Id')->on('posts')->onDelete('cascade');
    //         $table->string('Post_Type_Name')->unique();
    //         $table->timestamps();
    //     });
    //     Schema::create('post_type_contents', function (Blueprint $table) {
    //         $table->id('Post_Type_Contents_Id');
    //         $table->foreignId('Post_Id')->references('Post_Id')->on('posts')->onDelete('cascade');
    //         $table->foreignId('Post_Type_Id')->references('Post_Type_Id')->on('post__types')->onDelete('cascade');
    //         $table->string('Post_Type_Content_Name');
    //         $table->timestamps();
    //     });
    //     Schema::create('content_values', function (Blueprint $table) {
    //         $table->id('Content_Values_Id');
    //         $table->foreignId('Post_Id')->references('Post_Id')->on('posts')->onDelete('cascade');
    //         $table->foreignId('Post_Type_Id')->references('Post_Type_Id')->on('post__types')->onDelete('cascade');
    //         $table->foreignId('Post_Type_Contents_Id')->references('Post_Type_Contents_Id')->on('post_type_contents')->onDelete('cascade');
    //         $table->string('Content_Value_Name');
    //         $table->timestamps();
    //     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
