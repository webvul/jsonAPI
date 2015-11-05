<?php

namespace App\Jobs;

use App\Http\API\Twitter;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobTwitter extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;


    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        do
        {
            \Log::debug(__CLASS__ ."第{$this->attempts()}次 开始:".date('Y-m-d H:i:s'));
            $job = new Twitter();
            $job->getDATA();
            unset($job);

            \DB::reconnect();

            \Log::debug(__CLASS__ ."第{$this->attempts()}次 结束:".date('Y-m-d H:i:s'));
        }while(1);

    }


    /**
     * 处理失败任务
     *
     * @return void
     */
    public function failed()
    {
        \Log::debug(__CLASS__."任务失败?后面会怎么样呢?");
    }
}
