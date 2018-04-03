<?php

namespace Tests\Concerns;

use Tests\Support\PapertrailHttpApiClient;

trait CallsPapertrailApi
{
    protected static $lastEventId;
    protected static $host;
    protected static $port;
    protected static $papertrailClient;

    /** @beforeClass */
    public static function setupPapertrail()
    {
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
}