<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('chat_messages', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('from_user_id');
        $table->unsignedBigInteger('to_user_id');
        $table->text('message');
        $table->boolean('is_read')->default(false);
        $table->timestamp('read_at')->nullable();
        $table->timestamps();
        
        $table->foreign('from_user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('to_user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


};
