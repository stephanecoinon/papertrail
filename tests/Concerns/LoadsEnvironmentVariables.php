<?php

namespace Tests\Concerns;

use Dotenv\Dotenv;

/**
 * When a test case uses this trait, it must be listed last in the "use" statement so
 * that the setup method is ran first, making the environment variables available for
 * the other traits.
 */
trait LoadsEnvironmentVariables
{
    /** @beforeClass */
    public static function setUpEnvironmentVariables()
    {
        // Load .env config file if any
        $dotEnvPath = __DIR__.'/../..';
        if (file_exists($dotEnvPath.'/.env')) {
            $dotenv = new Dotenv($dotEnvPath);
            $dotenv->load();
        }
    }
}