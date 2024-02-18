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
            $table->increments('id');
            $table->boolean('liked');
            $table->boolean('disliked');
            $table->timestamps();

            $table->unsignedInteger('comment_id');
            $table->foreign('comment_id')
                ->references('id')
                ->on('comments')
                ->onDelete('cascade'); // thằng nhiều bị xóa thì thg 1 cũng bị xóa
            // ->onDelete('set null'); // thg 1 xóa thg nhiều k xóa..

            //foreign keys user
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); // thằng nhiều bị xóa thì thg 1 cũng bị xóa
            // ->onDelete('set null'); // thg 1 xóa thg nhiều k xóa..
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
