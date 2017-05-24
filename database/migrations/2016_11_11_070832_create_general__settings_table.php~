<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general__settings', function (Blueprint $table) {
            $table->integer('id');
            $table->string('logo')->nullable();
            $table->string('name');
            $table->string('email');
            $table->text('tags');
            $table->text('description');
            $table->timestamps();
        });

        DB::table('general__settings')->insert(
            array(
                ['id' => 1, 'name' => 'Amazing', 'email' => 'test@test.com', 'tags' => 'sport - movies - Games', 'description' => 'this is amazing website you can do whatever you want']
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
        Schema::drop('general__settings');
    }
}
