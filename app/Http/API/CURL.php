<?php

namespace App\Http\API;

//自定义curl类
class CURL
{
    static function get($url,$headers=[],$options=[]){

        $default_headers = [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36'
        ];

        $default_options = [
            'follow_redirects' => false,
            'timeout' => 30
        ];

        $headers = $headers + $default_headers;
        $options = $options + $default_options;



        //出错的话就访问10次
        for($i=1;$i<10;$i++)
        {

            echo "\r\n第{$i}次访问".$url;
            try{
                $json = \Requests::get($url,$headers,$options);
            }catch (\Requests_Exception $e) {
                continue;  //表示url访问出错了
            }
            \DB::reconnect();

            if($json->body!="")  break;  //表示访问正确
        }

        if($i==10){
            abort(300,'url读取10次都错误');
        }

        return $json->body;
    }
}