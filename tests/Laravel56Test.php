<?php

namespace Tests\Laravel56;

use Tests\LaravelContractTests;
use Tests\TestCase;
use Tests\DriverContractTests;

class Laravel56Test extends TestCase
{
    use LaravelContractTests, DriverContractTests;

    public $driver = \StephaneCoinon\Papertrail\Laravel5::class;
    
    public function setUp()
    {
        parent::setUp();
        $this->turnLaravelOn('5.6');
    }
}