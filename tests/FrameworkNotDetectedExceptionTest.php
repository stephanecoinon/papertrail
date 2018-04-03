<?php

namespace Tests;

use StephaneCoinon\Papertrail\Exceptions\FrameworkNotDetectedException;

class FrameworkNotDetectedExceptionTest extends TestCase
{
    /** @test */
    function it_formats_the_message()
    {
        $e = FrameworkNotDetectedException::inDriver(new DriverStub);

        $this->assertEquals(
            'Framework not detected: Tests\DriverStub driver must be used in PHP framework', 
            $e->getMessage()
        );
    }
}

class DriverStub
{

}