<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTWordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_word', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->timestamp('time');
        });

        DB::statement('alter table t_word change `time` `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('t_word');
    }
}
