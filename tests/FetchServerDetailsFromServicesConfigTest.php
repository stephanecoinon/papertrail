<?php

namespace Tests;

use StephaneCoinon\Papertrail\Laravel;
use Tests\Support\Container;

class FetchServerDetailsFromServicesConfigTest extends \PHPUnit\Framework\TestCase
{
    use Concerns\FakesLaravel,
        Concerns\LoadsFixtures;

    /**
     * @test
     * @dataProvider laravelVersions
     */
    function fetching_papertrail_host_and_port_from_services_config($version)
    {
        $this->turnLaravelOn($version);

        // With no environment variables defined
        putenv('PAPERTRAIL_HOST');
        putenv('PAPERTRAIL_PORT');

        // But server details set in services configuration
        Container::put('config', [
            'services.papertrail.host' => 'logs.papertrailapp.com',
            'services.papertrail.port' => 12345,
        ]);

        // Booting without paramaters
        $driver = new Laravel($host = null, $port = null);

        // Fetches the server details from the services configuration
        $this->assertEquals('logs.papertrailapp.com', $driver->getHost());
        $this->assertEquals(12345, $driver->getPort());
    }

    function laravelVersions()
    {
        return [['4.2'], ['5.0'], ['5.6']];
    }
}
