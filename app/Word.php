<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $table = 't_word';
    public $timestamps = false;

    //显示词的相关数据
    public function scopeShowList($query)
    {
        $query = $query
            ->leftJoin('t_word_job','t_word_job.word_id','=','t_word.id')
            ->groupBy('t_word.id')
            ->selectRaw('t_word.*,IFNULL(t_word_job.time,"正在排队中")  as sendTime ,IFNULL(sum(t_word_job.collection),"0") as collection');
       return $query;
    }

}
