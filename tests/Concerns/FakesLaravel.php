<?php

namespace Tests\Concerns;

use Tests\Support\Container;

trait FakesLaravel
{
    protected $laravelFrameworkPath = __DIR__.'/../fixtures/laravel/framework';

    public function turnLaravelOn($version)
    {
        Container::put('laravel.version', $version);

        // Install Application class stub
        @unlink($this->laravelFrameworkPath);
        symlink(
            $this->fixturePath("stubs/laravel/{$version}/framework"),
            $this->laravelFrameworkPath
        );
    }

    /** @after */
    public function turnLaravelOff()
    {
        // Uninstall Application
        @unlink($this->laravelFrameworkPath);

        Container::delete('laravel.version');
    }
}
