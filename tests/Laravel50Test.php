<?php

namespace Tests\Laravel50;

use Tests\LaravelContractTests;
use Tests\TestCase;
use Tests\DriverContractTests;

/**
 * Tests for Laravel versions >= 5.0 and < 5.6
 */
class Laravel50Test extends TestCase
{
    use LaravelContractTests, DriverContractTests;

    public $driver = \StephaneCoinon\Papertrail\Laravel5::class;

    public function setUp()
    {
        parent::setUp();
        $this->turnLaravelOn('5.0');
    }
}