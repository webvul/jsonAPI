<?php

namespace App\Http\API;


use App\DATA;
use App\TAPI;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FaceBook extends API
{
    public $job;            //接口信息

    //构造函数
    function __construct()
    {
        $this->job = TAPI::GetJob('facebook')->first();


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
                'picture' => @$val->picture,
                'description' => @$val->description,
                'url' => @$val->url,
                'from_id' =>@$val->from->id,
                'from_name' =>@$val->from->name,
                'link' => @$val->link,
                'created_time' => @date('Y-m-d H:i:s', strtotime($val->created_time)),
                'message' => @$val->message,
                'shares' => @$val->shares->count,
                'likes' => @$val->likes->count,
                'type' => @$val->type,
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


    }

    //获取下一夜连接
    public function toPage($json)
    {
        if($json->hasNext){
            $url = $this->toUrl();
            $url .= '&pageToken='.$json->pageToken;
            $url .= '&until='.$json->until;
            return $url;
        }else{
            return '';
        }


    }

    //根据API建表
    public function createTable($tablename)
    {
        \Schema::create($tablename, function (Blueprint $table) {
            $table->bigIncrements('rid');
            $table->string('id');
            $table->string('picture')->nullable();
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->string('url')->nullable();
            $table->timestamp('created_time')->nullable();
            $table->text('message')->nullable();
            $table->integer('shares')->nullable();
            $table->integer('likes')->nullable();
            $table->string('type', 50)->nullable();
            $table->string('from_id', 50)->nullable();
            $table->string('from_name', 50)->nullable();
            $table->timestamp('time');
            //$table->primary('rid');
            $table->unique('rid');
            $table->index('id');
            $table->index('time');
        });
    }


}