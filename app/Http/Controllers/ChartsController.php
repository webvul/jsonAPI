<?php

namespace App\Http\Controllers;

use App\DATA;
use App\Http\Requests;

class ChartsController extends Controller
{
    public  function getIndex($time='today')
    {



        $data['facebook'] = DATA::StatGather('data_facebook',$time);
        $data['twitter'] = DATA::StatGather('data_twitter',$time);




        $pie = [
            'facebook' =>0,
            'twitter' =>0,
        ];

        $x = [
            'facebook' =>[],
            'twitter' =>[],
        ];

        foreach($data['facebook'] as $k =>$v){
            $x['facebook'][] =  $k;
            $pie['facebook'] += (int)$v;
        }

        foreach($data['twitter'] as $k =>$v){
            $x['twitter'][] =  $k;
            $pie['twitter'] += (int)$v;
        }


        $x = array_unique($x['twitter']+$x['facebook']);
        sort($x);



        $xAxis = [];
        $count['facebook'] = [];
        $count['twitter'] = [];


        foreach($x as $k =>$v){
            $xAxis[] = substr($v,-2);
            $count['facebook'][] = isset($data['facebook'][$v])?$data['facebook'][$v]:0;
            $count['twitter'][] = isset($data['twitter'][$v])?$data['twitter'][$v]:0;
        }



        $line['xAxis'] = $xAxis;
        $line['facebook'] = $count['facebook'];
        $line['twitter'] = $count['twitter'];






        return view('charts.index')->with('line',$line)->with('time',$time)->with('pie',$pie);
    }
}
