<?php

namespace StephaneCoinon\Papertrail\Spec\Helpers;

use GuzzleHttp\Client as HttpClient;

class PapertrailHttpApiClient
{
    /**
     * @var GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var GuzzleHttp\Psr7\Response
     */
    protected $response;


    /**
     * Get a new Papertrail HTTP API client instance.
     * @param string $apiToken
     */
    public function __construct($apiToken)
    {
        $this->client = new HttpClient();
        $this->response = $this->client->request('GET', 'https://papertrailapp.com/api/v1/events/search.json', [
            'headers' => [
                'X-Papertrail-Token' => $apiToken,
            ],
        ]);
    }

    /**
     * Get all papertrail events
     * @return array
     */
    public function getEvents()
    {
        return json_decode((string) $this->response->getBody())->events;
    }

    /**
     * Get latest papertrail event
     * @return stdCLass
     */
    public function getLastEvent()
    {
        $events = $this->getEvents();
        if (count($events) > 0) {
            return $events[count($events) - 1];
        }

        return null;
    }
}
