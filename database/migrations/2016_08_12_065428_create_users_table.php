<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->string('avatar');
            $table->boolean('admin')->default(0);
            $table->boolean('ban')->default(0);
            $table->rememberToken()->nullable();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                ['username' => 'Admin', 'email' => 'test@test.com', 'password' => bcrypt('123'), 'avatar' => 'default.png', 'admin' => 1, 'ban' => 0]
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
