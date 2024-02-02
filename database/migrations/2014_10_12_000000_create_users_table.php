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

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('name', ['user', 'admin']);
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            // FK role
            $table->unsignedInteger('role_id')->default('1');
            // Thêm ràng buộc khóa ngoại
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
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
        Schema::dropIfExists('users');
    }
};
