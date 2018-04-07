<?php

namespace Tests;

/**
 * Tests for Laravel versions >= 5.0 and < 5.6
 */
class Laravel50Test extends TestCase
{
    use BootTests, LaravelContractTests;

    public $driverClass = \StephaneCoinon\Papertrail\Laravel::class;

    public function setUp()
    {
        parent::setUp();
        $this->turnLaravelOn('5.0');
    }
}