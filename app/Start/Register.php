<?php

namespace App\Start;

use GatewayWorker\Register as BaseRegister;

/**
 * 启动register进程
 *
 * Class Register
 */
class Register
{
    public static function init()
    {
        new BaseRegister("text://0.0.0.0:1238");
    }
}
