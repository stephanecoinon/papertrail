<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    use Concerns\CallsPapertrailApi,
        Concerns\FakesLaravel,
        Concerns\LoadsFixtures,
        Concerns\MakesAssertions,
        Concerns\LoadsEnvironmentVariables; // must be last so it's loaded first
}