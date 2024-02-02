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
        // mối quan hệ one-to-many (1-n)
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id'); // category_id
            $table->string('name');
            $table->longText('description');
            $table->timestamps();
        });

        Schema::create('food', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('count')->nullable(true);
            $table->longText('description');
            $table->timestamps();
            //foreign keys category
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
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
        Schema::dropIfExists('food');
    }
};
