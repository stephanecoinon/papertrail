<?php

namespace Tests;

trait BootTests
{
    /** @test */
    function booting_using_host_and_port_only()
    {
        $driver = $this->driverClass::boot(static::$host, static::$port);

        $message = 'this is a test log message';
        $driver->getLogger()->info($message);

        $this->waitForEventToBePushed();
        $this->assertStringContains($message, $this->getMostRecentMessage());
    }
    
    /** @test */
    function booting_using_prefix_only()
    {
        $prefix = '@PREFIX@';
        $driver = $this->driverClass::bootWithPrefix($prefix);

        $message = 'this is a test log message';
        $driver->getLogger()->info($message);

        $this->waitForEventToBePushed();
        $recentMessage = $this->getMostRecentMessage();
        $this->assertStringContains("[$prefix]", $recentMessage);
        $this->assertStringContains($message, $recentMessage);
    }

    /**
     * Wait a little for event to be pushed to papertrail.
     *
     * @return void
     */
    protected function waitForEventToBePushed()
    {
        sleep(2);
    }
}