<?php

namespace Tests;

use Exception;
use StephaneCoinon\Papertrail\Exceptions\LaravelNotDetectedException;

trait LaravelContractTests
{
    /** @test */
    function detecting_whether_laravel_is_installed()
    {
        $this->assertTrue($this->driver::isLaravelInstalled());
    }

    /** @test */
    function booting_when_in_a_laravel_app()
    {
        try {
            $this->driver::boot();
        } catch (LaravelNotDetectedException $e) {
            $this->fail('Laravel app was not detected although test is run in an app context');
            return;
        } catch (Exception $e) {
            $this->fail('Caught unexpected exception while booting driver: '.$e->getMessage());
            return;
        }

        $this->pass();
    }
}