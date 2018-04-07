<?php

namespace Tests;

use StephaneCoinon\Papertrail\Laravel;
use StephaneCoinon\Papertrail\Php;

class FetchServerDetailsFromEnvironmentVariablesTest extends \PHPUnit\Framework\TestCase
{
    use Concerns\FakesLaravel,
        Concerns\LoadsFixtures;

    /**
     * @test
     * @dataProvider frameworks
     */
    function fetching_papertrail_host_and_port_from_environment_variables($driverClass, $version)
    {
        $this->turnLaravelOn($version);

        putenv('PAPERTRAIL_HOST=logs.papertrailapp.com');
        putenv('PAPERTRAIL_PORT=12345');

        $driver = new $driverClass($host = null, $port = null);

        $this->assertEquals('logs.papertrailapp.com', $driver->getHost());
        $this->assertEquals(12345, $driver->getPort());
    }

    function frameworks()
    {
        return [
            [Php::class, ''],
            [Laravel::class, '4.2'],
            [Laravel::class, '5.0'],
            [Laravel::class, '5.6'],
        ];
    }
}
