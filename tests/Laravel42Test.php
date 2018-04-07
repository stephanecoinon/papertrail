<?php

namespace Tests;

class Laravel42Test extends TestCase
{
    use BootTests, LaravelContractTests;

    public $driverClass = \StephaneCoinon\Papertrail\Laravel::class;
     
    public function setUp()
    {
        parent::setUp();
        $this->turnLaravelOn('4.2');
    }
}