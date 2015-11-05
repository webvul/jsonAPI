<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTWordJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_word_job', function (Blueprint $table) {
            $table->bigInteger('word_id');
            $table->integer('api_id');
            $table->bigInteger('collection');
            $table->timestamp('time');
            $table->index('time');
            $table->primary(['word_id', 'api_id']);
        });

        DB::statement('alter table t_word_job change `time` `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP;');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('t_word_job');
    }
}
