<?php

namespace App\Service;

/**
 * 客户接待服务
 *
 * 当有客户链接上来时, 检查是否有客服在线, 如果有客服在线, 随机分配一个客服
 *
 * 如果所有的客服都不在线, 标记用户的信息未读, 转发给客服
 *
 * 等待客服上线事件, 将消息随机转发到客服
 *
 * @package App\Service\Customer
 */

class ReceiveService
{

    /**
     * 随机获取所有在线的客服_id
     *
     * 这里应该是一个异步的mysql 查询
     * @return array
     */
    public function getOnlineReceiver(): array
    {
        return [
            1001,
            1002,
            1003
        ];
    }

    // 随机分配一个在线的客服
    public function receiveCustomer($customer_id, $receiver_id)
    {

    }

    // 客服上线事件
    // 如果有留言,处理昨天的留言
    public function onReceiveLogin()
    {

    }



}
