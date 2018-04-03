<?php

namespace Tests;

use StephaneCoinon\Papertrail\Exceptions\LaravelNotDetectedException;
use StephaneCoinon\Papertrail\Laravel4;
use StephaneCoinon\Papertrail\Laravel5;

class LaravelDriverOutsideAppContextTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->turnLaravelOff();
    }

    /** @test */
    function detecting_whether_laravel_is_installed()
    {
        $this->assertFalse(Laravel4::isLaravelInstalled());
        $this->assertFalse(Laravel5::isLaravelInstalled());
    }

    /** @test */
    function laravel4_driver_throws_an_exception_when_not_in_a_laravel_app()
    {
        $this->assertDriverThrowsExceptionOnBoot(Laravel4::class);
    }

    /** @test */
    function laravel5_driver_throws_an_exception_when_not_in_a_laravel_app()
    {
        $this->assertDriverThrowsExceptionOnBoot(Laravel5::class);
    }

    protected function assertDriverThrowsExceptionOnBoot($driver)
    {
        $this->expectException(LaravelNotDetectedException::class);    

        $driver::boot();
    }
}