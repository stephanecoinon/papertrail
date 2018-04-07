<?php

namespace Tests;

class PhpTest extends TestCase
{
    use BootTests;

    public $driverClass = \StephaneCoinon\Papertrail\Php::class;

    protected function setUp()
    {
        parent::setUp();
        $this->turnLaravelOff();
    }
}