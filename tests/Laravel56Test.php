<?php

namespace Tests;

class Laravel56Test extends TestCase
{
    use BootTests, LaravelContractTests;

    public $driverClass = \StephaneCoinon\Papertrail\Laravel::class;
    
    public function setUp()
    {
        parent::setUp();
        $this->turnLaravelOn('5.6');
    }
}