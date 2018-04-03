<?php

namespace Tests;

class Laravel42Test extends TestCase
{
    use LaravelContractTests, DriverContractTests;

    public $driver = \StephaneCoinon\Papertrail\Laravel4::class;
     
    public function setUp()
    {
        parent::setUp();
        $this->turnLaravelOn('4.2');
    }
}