<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->integer('id');
            $table->text('welcoming_msg');
            $table->text('bestPost_msg');
            $table->text('banUsers_msg');
            $table->text('banPosts_msg');
            $table->text('banComments_msg');
            $table->timestamps();
        });

        DB::table('messages')->insert(
            array(
                ['id' => 1, 'welcoming_msg' => 'Hello', 'bestPost_msg' => 'Best posts', 'banUsers_msg' => 'you are banned', 'banPosts_msg' => 'Banned Posts', 'banComments_msg' => 'Banned comment']
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
        Schema::drop('messages');
    }
}
