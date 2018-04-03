<?php

namespace StephaneCoinon\Papertrail;

use StephaneCoinon\Papertrail\Exceptions\LaravelNotDetectedException;

class Laravel4 extends Base
{
    public static $defaultLoggerName = 'Laravel4Papertrail';

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
        return app('log')->getMonolog();
    }
}
