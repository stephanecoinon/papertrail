<?php

namespace StephaneCoinon\Papertrail;

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
    protected function detectFrameworkOrFail()
    {
        if (! $this->isLaravelInstalled()) {
            throw LaravelNotDetectedException::inDriver($this);
        }

        return $this;
    }

    /**
     * Get the logger instance.
     *
     * @return \Psr\Log\LoggerInterface
     */
    public function getLogger()
    {
        $logger = app('log');

        // Laravel < 5.6
        if ($logger instanceof \Illuminate\Log\Writer) {
            return $logger->getMonolog();
        }

        // Laravel >= 5.6
        return $logger->getLogger();
    }
}
