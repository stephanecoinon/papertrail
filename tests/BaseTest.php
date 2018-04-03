<?php

namespace Tests;

use Tests\TestCase;
use Tests\TestsImplementation;

class BaseTest extends TestCase
{
    use TestsImplementation;

    public $implementation = \StephaneCoinon\Papertrail\Base::class;
}