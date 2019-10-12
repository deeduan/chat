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

$worker = new Worker();
$worker->onWorkerStart = 'connect';
function connect(){
    static $count = 0;
    // 2000个链接
    if ($count++ >= 230) return;
    // 建立异步链接
    $con = new AsyncTcpConnection('ws://127.0.0.1:8282');
    $con->tipNumber = $count;
    $con->onConnect = function($con) {
        // 递归调用connect
        connect();
    };
    $con->onMessage = function($con, $msg) {
        // echo "recv $msg\n";
    };

    $con->onClose = function($con) {
        echo "con close $con->tipNumber \n";
    };

    // 当前链接每10秒发个心跳包
    Timer::add(1, function()use($con){
        $con->send("ping");
    });
    $con->connect();
    echo $count, " connections complete\n";
}

Worker::runAll();
