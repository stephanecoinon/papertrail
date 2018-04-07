<?php

namespace StephaneCoinon\Papertrail;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\SyslogUdpHandler;

class Php
{
    public static $defaultLoggerName = 'PHP';

    /**
     * Papertrail host.
     *
     * @var string
     */
    protected $host;

    /**
     * Papertrail server port.
     *
     * @var int
     */
    protected $port;

    /**
     * Log message prefix.
     *
     * @var string
     */
    protected $prefix;

    /**
     * Underlying logger instance.
     * 
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * Make a new PHP driver to send logs to Papertrail.
     *
     * @param  null|string $host   Papertrail log server, ie log.papertrailapp.com
     * @param  null|int $port      Papertrail port number for log server
     * @param  string $prefix Prefix to use for each log message
     */
    public function __construct($host = null, $port = null, $prefix = '')
    {
        list($this->host, $this->port) = $this->resolveServerDetails($host, $port);
        $this->prefix = $prefix;
    }

    /**
     * Boot connector with given host, port and log message prefix.
     * 
     * If host or port are omitted, we'll try first to fetch them from the framework
     * services configuration otherwise we'll default to the environment variables
     * PAPERTRAIL_HOST and PAPERTRAIL_PORT.
     * 
     * @param  null|string $host   Papertrail log server, ie log.papertrailapp.com
     * @param  null|int $port      Papertrail port number for log server
     * @param  string $prefix Prefix to use for each log message
     * @return static
     */
    public static function boot($host = null, $port = null, $prefix = '')
    {
        $driver = new static($host, $port, $prefix);
        $driver->detectFrameworkOrFail();
        $driver->registerPapertrailHandler();

        return $driver;
    }

    /**
     * Boot connector using host and port set in configuration or environment
     * variables, and the given log message prefix.
     * 
     * @param string $prefix Prefix to use for each log message
     * @return static
     */
    public static function bootWithPrefix($prefix)
    {
        return static::boot(null, null, $prefix);
    }

    /**
     * Get Papertrail host.
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Get Papertrail server port.
     *
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Get log message prefix.
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Get log message format.
     *
     * @return string
     */
    public function getLogFormat()
    {
        $prefix = $this->prefix ? '['.$this->prefix.'] ' : '';
        
        return "{$prefix}%channel%.%level_name%: %message% %extra%";
    }

    /**
     * Resolve the server details if not provided.
     *
     * @param  string $host
     * @param  int $port
     * @return array [$host, $port]
     */
    public function resolveServerDetails($host, $port)
    {
        $host or $host = getenv('PAPERTRAIL_HOST');
        $port or $port = getenv('PAPERTRAIL_PORT');

        return [$host, $port];
    }

    /**
     * Get the underlying logger instance.
     * 
     * @return \Psr\Log\LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * Throw an exception if the framework for this driver is not detected
     *
     * @return $this
     * @throws Exceptions\FrameworkNotDetectedException
     */
    protected function detectFrameworkOrFail()
    {
        // no framework to detect in a plain PHP context
        return $this;
    }

    /**
     * Retrieve the logger instance.
     *
     * @return \Psr\Log\LoggerInterface
     */
    public function makeLogger()
    {
        $this->logger = new \Monolog\Logger(static::$defaultLoggerName);

        return $this->logger;
    }

    /**
     * Return new Papertrail SysLog handler instance.
     *
     * @return \Monolog\Handler\HandlerInterface
     */
    protected function makeHandler()
    {
        $syslog = new SyslogUdpHandler($this->host, $this->port);
        $formatter = new LineFormatter($this->getLogFormat());
        $syslog->setFormatter($formatter);

        return $syslog;
    }

    /**
     * Register papertrail log handler with the current logger.
     *
     * @return \Psr\Log\LoggerInterface
     */
    protected function registerPapertrailHandler()
    {
        return $this->makeLogger()->pushHandler($this->makeHandler());
    }
}
