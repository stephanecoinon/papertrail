<?php

namespace Tests;

use StephaneCoinon\Papertrail\Exceptions\LaravelNotDetectedException;
use StephaneCoinon\Papertrail\Laravel;

class LaravelDriverOutsideAppContextTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->turnLaravelOff();
    }

    /** @test */
    function laravel_driver_throws_an_exception_when_not_in_a_laravel_app()
    {
        $this->expectException(LaravelNotDetectedException::class);    

        Laravel::boot();
    }
}