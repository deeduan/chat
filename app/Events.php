<?php

namespace App;

use \GatewayWorker\Lib\Gateway;

/**
 * 默认的business worker进程业务处理类
 *
 * Class Events
 */

class Events
{
    /**
     * 当客户端连接时触发
     * 如果业务不需此回调可以删除onConnect
     * @param $client_id
     * @throws \Exception
     */
    public static function onConnect($client_id)
    {
        // 用户上线后~  将用户和客服u_id 绑定起来
        // 给当前客户端发送一条消息 - xxx 客服接待了你
        // 此后该客户端发来的消息, 都转发给这个客服

        // 向当前client_id发送数据
        Gateway::sendToClient($client_id, "Hello $client_id\r\n");
        // 向所有人发送
        Gateway::sendToAll("$client_id login\r\n");
    }

    /**
     * 当客户端发来消息时触发
     * @param int $client_id 连接id
     * @param mixed $message 具体消息
     * @throws \Exception
     */
    public static function onMessage($client_id, $message)
    {
        // 正常情况~  客服在线,用户也在线
        // 用户发来消息时, 转发给指定的客服, 这里我们需要保存客服的客户端连接
        // 客服的客户端连接, 需要一直给服务端发送心跳包

        // 向所有人发送
        Gateway::sendToAll("$client_id said $message\r\n");
    }

    /**
     * 当用户断开连接时触发
     * @param int $client_id 连接id
     * @throws \Exception
     */
    public static function onClose($client_id)
    {
        // 向所有人发送
        GateWay::sendToAll("$client_id logout\r\n");
    }
}
