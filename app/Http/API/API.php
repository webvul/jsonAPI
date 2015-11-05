<?php

namespace App\Http\API;

//抓去API接口模版
class API
{

    /*
     * 获取整个数据
     * 流程 :  获取api入口地址->获取内容->ETL到数据库->获取下一页url->获取内容
     */
    public function getDATA()
    {

        $url = $this->toUrl();
        $i = 0;
        do{
            $json = $this->getJson($url);

            \DB::reconnect();
            $ret = $this->toMysql($json);
            if(!$ret){
                //返回false表示数据完全重复,即结束本次采集
                echo "\r\n采集数据数据库中已存在,放弃翻页";
                break;
            }


            $url = $this->toPage($json);
            if($url==''){
                //如果没有下一页则结束
                echo "\r\n没有下一页结束翻页";
               // \Log::debug("没有下一页结束翻页");
                break;
            }
        }while(++$i<100); //翻页大于100的时候结束


    }

    //获取抓取数据的url
    public function toUrl()
    {
        $url = str_replace("{{keyword}}", urlencode($this->job->word_name), $this->job->url);
        return $url;
    }

    //获取json数据
    public function getJson($url)
    {
        $html = CURL::get($url,[],['timeout'=>30]);

        $json = json_decode($html);

        return $json;
    }
}