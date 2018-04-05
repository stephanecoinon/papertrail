<?php

namespace StephaneCoinon\Papertrail;

class Laravel5 extends Laravel4
{
    public static $defaultLoggerName = 'Laravel5Papertrail';

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
