<?php

namespace App\Http\Controllers;

use App\Http\API\FaceBook;
use App\Http\API\Twitter;
use App\Jobs\JobFacebook;
use App\Jobs\JobTwitter;
use App\TAPI;
use App\Http\Requests;


//api列表
class apiController extends Controller
{
    public function getIndex()
    {
        $api = TAPI::ListShow()->get();
        return view('api.index')->with('api',$api);
    }

    public function getSend(){
        set_time_limit(300);

        //调试信息
        \Debugbar::startMeasure('job','job执行时间');
        $job = new Twitter();
        $job->getDATA();
        //调试信息
        \Debugbar::stopMeasure('job');

    }

    public function getTest()
    {
        $this->dispatch((new JobFacebook())->onQueue('facebook'));
        $this->dispatch((new JobTwitter())->onQueue('twitter'));
    }



}
