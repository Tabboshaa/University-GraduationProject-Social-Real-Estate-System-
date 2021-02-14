<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('Notification_Id');
            $table->foreignId('To_User_Id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('From_User_Id')->references('id')->on('users')->onDelete('cascade');
            $table->string('Notification');
            $table->string('Redirect_To')->nullable();
            $table->boolean('Viewed')->default(0);
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
        Schema::dropIfExists('notifications');
    }
}
