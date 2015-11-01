<?php

namespace StephaneCoinon\Papertrail;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\SyslogUdpHandler;

class Laravel4
{
    /**
     * Boot connector with given host, port and log message prefix.
     * If host or port are omitted, we'll try to get them from the environment
     * variables PAPERTRAIL_HOST and PAPERTRAIL_PORT.
     * @param  string $host   Papertrail log server, ie log.papertrailapp.com
     * @param  int $port      Papertrail port number for log server
     * @param  string $prefix Prefix to use for each log message
     */
    public static function boot($host = null, $port = null, $prefix = '')
    {
        $host or $host = getenv('PAPERTRAIL_HOST');
        $port or $port = getenv('PAPERTRAIL_PORT');
        $prefix and $prefix = "[$prefix] ";

        $monolog = static::getMonolog();
        $syslog = new SyslogUdpHandler($host, $port);
        $formatter = new LineFormatter("$prefix%channel%.%level_name%: %message% %extra%");
        $syslog->setFormatter($formatter);
        $monolog->pushHandler($syslog);

        return $monolog;
    }

    /**
     * Boot connector using credentials set in environment variables and the
     * given log message prefix.
     * @param  [type] $prefix Prefix to use for each log message
     */
    public static function bootWithPrefix($prefix)
    {
        return static::boot(null, null, $prefix);
    }

    protected static function getMonolog()
    {
        // Use facade if it is available
        if (class_exists('Log')) {
            return Log::getMonolog();
        }

        // otherwise create a new instance
        return new \Monolog\Logger('Laravel4Papertrail');
    }
}
