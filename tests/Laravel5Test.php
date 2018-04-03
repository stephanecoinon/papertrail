<?php

namespace Tests;

use Tests\TestCase;
use Tests\TestsImplementation;

class Laravel5Test extends TestCase
{
    use TestsImplementation;

    public $implementation = \StephaneCoinon\Papertrail\Laravel5::class;
}