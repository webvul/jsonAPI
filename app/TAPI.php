<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TAPI extends Model
{
    protected $table = 't_api';
    public $timestamps = false;


    //获取一个采集任务
    static function GetJob($api_name)
    {
        $api = \DB::table('t_api')->where('api',$api_name)->first();


        $query = \DB::table('t_word')
            ->selectRaw('t_word.id as word_id,t_word.name as word_name,
            "'.$api->id.'" as api_id,
            "'.$api->api.'" as api_class,
            "'.$api->url.'" as url,
            "'.$api->tables.'" as tables,
            `t_word_job`.`time`
            ')
            ->leftJoin('t_word_job','t_word_job.word_id', "= t_word.id and t_word_job.api_id = '$api->id' and '$api->id' =", 't_word_job.api_id')
            ->orderBy('t_word_job.time','asc');
        return $query;
    }

    //更新任务
    static function UpJob($where)
    {
        $query = \DB::table('t_word_job')->where($where);
        $qt = $query->first();
        if($qt){
            $update['time'] = date('Y-m-d H:i:s',time());
            $update['collection'] = $qt->collection +1;
            $query->update($update);
        }else{
            $where['time'] = date('Y-m-d H:i:s');
            $query->insert($where);
        }
    }

    //获取列表信息
    public function scopeListShow($query)
    {
        $query = $query->selectRaw('t_api.*  ,
        (select count(*)  from jobs where jobs.queue=t_api.api and jobs.reserved=1) reserved,
        (select count(*)  from jobs where jobs.queue=t_api.api ) jobs');
        return $query;

    }


}
