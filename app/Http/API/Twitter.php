<?php

namespace App\Http\API;


use App\DATA;
use App\TAPI;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Twitter extends API
{
    public $job;            //接口信息

    //构造函数
    function __construct()
    {

        $this->job = TAPI::GetJob('twitter')->first();

        TAPI::UpJob([
            'api_id'    =>  $this->job->api_id,
            'word_id'    =>  $this->job->word_id
        ]);

    }


    //写入数据库
    public function toMysql($json)
    {
        $data = [];


        if(isset($json->data)&&count($json->data)){

        }else{
            return false;       //数据集为空
        }

        //循环json的值
        foreach ($json->data as $key => $val) {
            $data[$key] = [
                'id' => @$val->id,
                'uid' => @$val->uid,
                'likeCount' => @$val->likeCount,
                'message' => @$val->message,
                'url' =>@$val->url,
                'name' =>@$val->name,
                'shareCount' => @$val->shareCount,
                'created_time' => @date('Y-m-d H:i:s', strtotime($val->created_time)),
                'time' => date('Y-m-d H:i:s')
            ];
        }

        //$table = $this->job->tables.'_'.date('Ym');     //按月建立
        $table = $this->job->tables;
        $ts = \Schema::hasTable($table);
        if (!$ts) {
            $this->createTable($table);
        }

        $sp = 0;
        //批量写入数据库
        foreach ($data as $v) {
            $d = DATA::TableGroup($this->job->tables, ['id' => $v['id']]);
            if (count($d)) {
                $sp++;
            }else{
                //不存在就写入
                \DB::table($table)->insert($v);
            }
        }

        //如果数据完全和数据库中的数据匹配,则返回false
        return count($data) == $sp?false:true;



        //\DB::table($this->job->tables)->insert($data);


    }

    //获取下一夜连接
    public function toPage($json)
    {
        if($json->hasNext){
            $url = $this->toUrl();
            $url .= '&pageToken='.$json->pageToken;
            return $url;
        }else{
            return '';
        }


    }

    //根据api建表
    public function createTable($tablename)
    {
        \Schema::create($tablename, function (Blueprint $table) {
            $table->bigIncrements('rid');
            $table->string('id');
            $table->string('uid')->nullable();
            $table->integer('likeCount')->nullable();
            $table->string('url')->nullable();
            $table->string('name')->nullable();
            $table->integer('shareCount')->nullable();
            $table->text('message')->nullable();
            $table->timestamp('created_time')->nullable();
            $table->timestamp('time');
            $table->unique('rid');
            $table->index('id');
            $table->index('time');

           // $table->primary('rid');
        });
    }


}