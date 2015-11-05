<?php

namespace App\Jobs;

use App\Http\API\FaceBook;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobFacebook extends Job implements SelfHandling, ShouldQueue
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
            echo "\r\n".__CLASS__."开始:".date('Y-m-d H:i:s');
            $job = new FaceBook();
            $job->getDATA();
            unset($job);
            \DB::reconnect();

            echo "\r\n".__CLASS__."结束:".date('Y-m-d H:i:s');
        }while(1);

    }

    /**
     * 处理失败任的沙发务
     *
     * @return void
     */
    public function failed()
    {
        \Log::debug("Facebook任务失败?后面会怎么样呢?");
    }

}
