<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTApiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_api', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->string('url');
            $table->string('tables');
            $table->string('api',50);
            $table->timestamp('time');
        });

        DB::statement('alter table t_api change `time` `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP;');


        DB::table('t_api')->insert([
            'name' => 'facebook脸书',
            'url' => 'http://182.92.221.247/post/facebook?kw={{keyword}}',
            'tables' => 'data_facebook',
            'api' => 'facebook',
        ]);

        DB::table('t_api')->insert([
            'name' => 'twitter',
            'url' => 'http://182.92.221.247/post/twitter?kw={{keyword}}',
            'tables' => 'data_twitter',
            'api' => 'twitter',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('t_api');
    }
}
