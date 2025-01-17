<?php

namespace App;

use Monolog\Logger as MonologLogger;
use Monolog\Handler\StreamHandler;

class Logger
{
    private static $logger;

    /**
     * Obtiene la instancia del logger.
     *
     * @return MonologLogger
     */
    public static function getLogger(): MonologLogger
    {
        if (self::$logger === null) {
            $logDir = __DIR__ . '/../logs';

            // Crear el directorio de logs si no existe
            if (!is_dir($logDir)) {
                mkdir($logDir, 0777, true);
            }

            self::$logger = new MonologLogger('CancionLogger');

            // Manejador principal para todos los niveles de log
            $logFile = $logDir . '/app.log';
            self::$logger->pushHandler(new StreamHandler($logFile, MonologLogger::DEBUG));

            // Manejador adicional solo para errores críticos
            $errorLogFile = $logDir . '/error.log';
            self::$logger->pushHandler(new StreamHandler($errorLogFile, MonologLogger::ERROR));
        }

        return self::$logger;
    }
}
