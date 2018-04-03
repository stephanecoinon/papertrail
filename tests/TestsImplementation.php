<?php

namespace Tests;

/**
 * Tests one implementation (Base, Laravel4, or Laravel5), set in implementation
 * property of TestCase.
 */
trait TestsImplementation
{
    /** @ test */
    function booting_using_host_and_port_only()
    {
        $logger = $this->implementation::boot($this->host, $this->port);

        $message = 'this is a test log message';
        $logger->info($message);

        $this->waitForEventToBePushed();
        $this->assertStringContains($message, $this->getMostRecentMessage());
    }

    /** @test */
    function booting_using_prefix_only()
    {
        $prefix = '@PREFIX@';
        $logger = $this->implementation::bootWithPrefix($prefix);

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