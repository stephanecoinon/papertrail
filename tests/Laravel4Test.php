<?php

namespace Tests;

use Tests\TestCase;
use Tests\TestsImplementation;

class Laravel4Test extends TestCase
{
    use TestsImplementation;

    public $implementation = \StephaneCoinon\Papertrail\Laravel4::class;
}