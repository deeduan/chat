<?php

namespace App\Start;

use \GatewayWorker\BusinessWorker as BaseBusinessWorker;
use App\Events;


/**
 * 启动business worker 进程
 *
 * Class BusinessWorker
 */
class BusinessWorker
{
    public static function init()
    {
        // bussinessWorker 进程
        $worker = new BaseBusinessWorker();
        // worker名称
        $worker->name = 'chatBusinessWorker';
        // bussinessWorker进程数量
        $worker->count = 2;
        // 服务注册地址
        $worker->registerAddress = '127.0.0.1:1238';
        // 业务处理类 使用自定义的时需要重写命名空间的完整类名
        $worker->eventHandler = Events::class;
    }
}
