<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->integer('likeable_id')->unsigned()->index();
            $table->string('likeable_type');
            $table->unsignedBigInteger('user_id');
            $table->unique(['likeable_id','user_id','likeable_type']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // $table->foreignId('tweet_id')->constrained()->onDelete('cascade');
            // $table->unsignedInteger('likeable_id');
            // $table->boolean('liked');
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
        Schema::dropIfExists('likes');
    }
};
