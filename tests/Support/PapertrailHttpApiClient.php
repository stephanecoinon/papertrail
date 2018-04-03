<?php

namespace Tests\Support;

use GuzzleHttp\Client as HttpClient;

class PapertrailHttpApiClient
{
    public const BASE_URI = 'https://papertrailapp.com/api/v1/';
    public const EVENT_SEARCH_ENDPOINT = 'events/search.json';

    /**
     * @var GuzzleHttp\Client
     */
    protected $client;


    /**
     * Get a new Papertrail HTTP API client instance.
     * 
     * @param string $apiToken
     */
    public function __construct($apiToken)
    {
        $this->client = new HttpClient([
            'base_uri' => static::BASE_URI,
            'headers' => [
                'X-Papertrail-Token' => $apiToken,
            ],
        ]);
    }

    /**
     * Make a GET request.
     *
     * @param string $uri
     * @param array $params
     * @return \GuzzleHttp\Psr7\Response
     */
    public function get($uri, $params = [])
    {
        return $this->client->get($uri, [
            'query' => $params,
        ]);
    }

    /**
     * Make a GET request and return the decoded JSON response.
     *
     * @param string $uri
     * @param array $params
     * @return object
     */
    public function getJson($uri, $params = [])
    {
        return json_decode((string) $this->get($uri, $params)->getBody());
    }

    /**
     * Make a request to search the events.
     *
     * @param array $params
     * @return object
     */
    public function searchEvents($params = [])
    {
        return $this->getJson(static::EVENT_SEARCH_ENDPOINT, $params);
    }

    /**
     * Get all papertrail events.
     * 
     * @return object[]
     */
    public function getEvents()
    {
        return $this->searchEvents()->events;
    }

    /**
     * Get latest papertrail event.
     * 
     * @param null|string $lastId if specified, only an event with a posterior id will be returned
     * @return null|object
     */
    public function getLastEvent($lastId = null)
    {
        $params = ['limit' => 1];
        $lastId and $params += ['min_id' => $lastId];

        $events = $this->searchEvents($params)->events;

        return $events ? $events[0] : null;
    }
}
