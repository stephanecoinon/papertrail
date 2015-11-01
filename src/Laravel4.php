<?php

namespace StephaneCoinon\Papertrail;

class Laravel4 extends Base
{
    public static $defaultLoggerName = 'Laravel4Papertrail';

    protected static function getMonolog()
    {
        // Use facade if it is available
        if (class_exists('Log')) {
            return \Log::getMonolog();
        }

        // otherwise create a new instance
        return parent::getMonolog();
    }
}
