<?php

namespace App;

use Monolog\Logger as MonologLogger;
use Monolog\Handler\StreamHandler;

class Logger
{
    private static $logger;

    public static function getLogger(): MonologLogger
    {
        if (self::$logger === null) {
            self::$logger = new MonologLogger('app');
            $logFile = __DIR__ . '/../logs/app.log';
            self::$logger->pushHandler(new StreamHandler($logFile, MonologLogger::DEBUG));
        }

        return self::$logger;
    }
}
