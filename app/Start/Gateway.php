<?php

namespace App\Start;

use GatewayWorker\Gateway as BaseGateway;

/**
 * 启动gateway进程
 *
 * Class Gateway
 */

class Gateway
{
    public static function init()
    {
        // websocket
        $gateway = new BaseGateway("websocket://0.0.0.0:8282");
        // gateway名称，status方便查看
        $gateway->name = 'chatGateway';
        // gateway进程数
        $gateway->count = 1;
        // 本机ip，分布式部署时使用内网ip
        $gateway->lanIp = '127.0.0.1';
        // 内部通讯起始端口，假如$gateway->count=4，起始端口为4000
        // 则一般会使用4000 4001 4002 4003 4个端口作为内部通讯端口
        $gateway->startPort = 4000;

        // 暂时不处理心跳
//        $gateway->pingInterval = 30;
//        $gateway->pingNotResponseLimit = 1;

        // 服务注册地址
        $gateway->registerAddress = '127.0.0.1:1238';
    }

    /**
     * 可能会设置连接回调
     */
    public static function onConnect()
    {

    }

}
