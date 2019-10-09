<?php

/**
 * 启动应用
 *
 * @author dee<dee.undercut@gmail.com>
 */

use App\Start\Register;
use App\Start\Gateway;
use App\Start\BusinessWorker;
use Workerman\Worker;

// 定义应用启动
define('APP_START', microtime(true));

// 自动加载
require_once __DIR__."/../vendor/autoload.php";

BusinessWorker::init();
Gateway::init();
Register::init();

Worker::runAll();
