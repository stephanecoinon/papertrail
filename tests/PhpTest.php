<?php

namespace Tests;

class BaseTest extends TestCase
{
    use DriverContractTests;

    public $driver = \StephaneCoinon\Papertrail\Php::class;

    protected function setUp()
    {
        parent::setUp();
        $this->turnLaravelOff();
    }
}