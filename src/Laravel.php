<?php

namespace StephaneCoinon\Papertrail;

use Illuminate\Support\Facades\Config;
use StephaneCoinon\Papertrail\Exceptions\LaravelNotDetectedException;

class Laravel extends Php
{
    public static $defaultLoggerName = 'Laravel';

    /**
     * Is Laravel installed?
     *
     * @return boolean
     */
    public function isLaravelInstalled()
    {
        return class_exists('Illuminate\Foundation\Application');
    }

    /**
     * {@inheritDoc}
     */
    public function resolveServerDetails($host, $port)
    {
        // Try the services configuration
        if (class_exists('Illuminate\Support\Facades\Config')) {
            $host or $host = Config::get('services.papertrail.host');
            $port or $port = Config::get('services.papertrail.port');
        }

        return parent::resolveServerDetails($host, $port);
    }

    /**
     * {@inheritDoc}
     */
    protected function detectFrameworkOrFail()
    {
        if (! $this->isLaravelInstalled()) {
            throw LaravelNotDetectedException::inDriver($this);
        }

        return $this;
    }

    /**
     * Retrieve the logger instance.
     *
     * @return \Illuminate\Log\Writer|\Psr\Log\LoggerInterface
     */
    public function makeLogger()
    {
        $laravelLogger = app('log');

        $method = $laravelLogger instanceof \Illuminate\Log\Writer
            ? 'getMonolog' // Laravel < 5.6
            : 'getLogger'; // Laravel >= 5.6
        
        $this->logger = $laravelLogger->$method();

        return $this->logger;
    }
}
