<?php

namespace Tests;

/**
 * Tests one driver implementation (Base, Laravel4, or Laravel5).
 * 
 * Set the driver class path in the driver property of TestCase.
 */
trait DriverContractTests
{
    /** @ test */
    function booting_using_host_and_port_only()
    {
        $logger = $this->driver::boot($this->host, $this->port);

        $message = 'this is a test log message';
        $logger->info($message);

        $this->waitForEventToBePushed();
        $this->assertStringContains($message, $this->getMostRecentMessage());
    }

    /** @test */
    function booting_using_prefix_only()
    {
        $prefix = '@PREFIX@';
        $logger = $this->driver::bootWithPrefix($prefix);

        $message = 'this is a test log message';
        $logger->info($message);

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