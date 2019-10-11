<?php

/**
 * websocket的性能测试脚本
 *
 * 2000个链接
 * @author dee<dee.undercut@gmail.com>
 */


require_once __DIR__."/../vendor/autoload.php";
use Workerman\Worker;
use Workerman\Lib\Timer;
use Workerman\Connection\AsyncTcpConnection;

function connect() {
    // 建立异步链接
    $con = new AsyncTcpConnection('ws://127.0.0.1:8282');

    // 顺序建立链接
    $con->onConnect = function($con) {
//        connect();
    };

    $con->onMessage = function($con, $msg) {
        echo "recv $msg\n";
    };

    $con->onClose = function($con) {
        echo "con close\n";
    };

    // 定时器 每10s发送一个消息
    Timer::add(3, function()use($con){
        $con->send("ping test");
    });

    $con->connect();

    echo " connections complete\r\n";
}

for ($i = 0; $i < 2000; $i++) {

    $worker = new Worker();

    $worker->count = 1;

    $worker->onWorkerStart = 'connect';

}

// 压测10分钟  10分钟后关掉客户端
//Timer::add(10 * 60, function(){
//    file_put_contents('/tmp/workerman_stop', time());
//
//    $master_pid = \is_file(Worker::$pidFile) ? \file_get_contents(Worker::$pidFile) : 0;
//
//    // 给客户端发送一个平滑停止信号
//    \posix_kill($master_pid, SIGTERM);
//});

Worker::runAll();
