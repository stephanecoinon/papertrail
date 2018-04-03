<?php

namespace Tests;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Tests\Helpers\PapertrailHttpApiClient;

class TestCase extends BaseTestCase
{
    protected static $lastEventId;
    protected static $host;
    protected static $port;
    protected static $papertrailClient;

    public static function setUpBeforeClass()
    {
        // Load .env config file if any
        $dotenv = new Dotenv(__DIR__.'/..');
        $dotenv->load();

        // Set test fixtures
        static::$host = getenv('PAPERTRAIL_HOST');
        static::$port = getenv('PAPERTRAIL_PORT');
        static::$papertrailClient = new PapertrailHttpApiClient(getenv('PAPERTRAIL_API_TOKEN'));

        // Seed last event id
        static::getLastEvent();
    }

    protected static function getLastEvent($lastId = null)
    {
        $lastEvent = static::$papertrailClient->getLastEvent($lastId);

        if ($lastEvent) {
            static::$lastEventId = $lastEvent->id;
        }

        return $lastEvent;
    }

    protected static function getMostRecentEvent()
    {
        return static::getLastEvent(static::$lastEventId);
    }

    protected function getMostRecentMessage()
    {
        $event = static::getMostRecentEvent();

        return $event ? $event->message : '';
    }

    /**
     * Assert that $haystack contains $needle.
     * 
     * @param string $needle string expected to be found in $haystack
     * @param string $haystack
     * @return void
     */
    protected function assertStringContains($needle, $haystack, $message = '')
    {
        $message or $message = "Failed asserting that \"$haystack\" contains \"$needle\".";

        $this->assertTrue(strpos($haystack, $needle) !== false, $message);
    }
}