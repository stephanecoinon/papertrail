<?php

namespace Tests;

class BaseTest extends TestCase
{
    use DriverContractTests;

    public $driver = \StephaneCoinon\Papertrail\Base::class;

    protected function setUp()
    {
        parent::setUp();
        $this->turnLaravelOff();
    }
}