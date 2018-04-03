<?php

namespace Tests\Concerns;

trait LoadsFixtures
{
    public function fixturePath($path = '')
    {
        return __DIR__.'/../fixtures/'.$path;
    }

    public function fixture($path)
    {
        return file_get_contents($this->fixturePath($path));
    }
}