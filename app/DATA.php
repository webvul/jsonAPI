<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DATA extends Model
{
    protected $table = 't_api';
    public $timestamps = false;


    //获取一个组合表的数据
    static function TableGroup($like_table,$where)
    {
        //获取表名
        $tables = \DB::table('information_schema.tables')
            ->where('table_type','base table')
            ->where('table_name','like',$like_table.'%')->lists('TABLE_NAME');

        $qs = array();
        foreach($tables as $key =>$val)
        {
            $tmp = \DB::table($val)
                ->where($where)
                ->get();
            $qs = array_merge($qs, (array)$tmp);  //合并数组
        }

        return $qs;
    }


    //获取统计信息
    static function StatGather($table,$day){

        switch($day){
            case 'hour': $time = date("Y-m-d H:00:00",time());$s1 = '%Y%m%d%H%i';$s2 = '%Y%m%d%H';break;
            case 'today': $time = date("Y-m-d",time());$s1 = '%Y%m%d%H';$s2 = '%Y%m%d';break;
            case 'yesterday': $time = date("Y-m-d",strtotime("-1 day"));$s1 = '%Y%m%d%H';$s2 = '%Y%m%d';break;
            case 'month': $time = date("Y-m-d",strtotime("-1 month"));$s1 = '%Y%m%d';$s2 = '%Y%m';break;
            case 'year' : $time = date("Y-m-d",strtotime("-1 year"));$s1 = '%Y%m';$s2 = '%Y';break;
            default: return [];
        }

        $data = \DB::table($table)
            ->selectRaw("DATE_FORMAT(`time`,'{$s1}') x ,count(*) as count")
            ->whereRaw("`time` >= '$time'")
            ->groupBy("x")
            ->get();

        $ret=[];
        foreach($data as $k=>$v){
            $ret[$v->x]=$v->count;
        }
        return $ret;
    }

}
