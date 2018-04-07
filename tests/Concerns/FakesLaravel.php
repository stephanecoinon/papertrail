<?php

namespace Tests\Concerns;

use Tests\Support\Container;

trait FakesLaravel
{
    protected $laravelFrameworkPath = __DIR__.'/../fixtures/laravel/framework';

    public function turnLaravelOn($version)
    {
        if (! $version) {
            $this->turnLaravelOff();
            return;
        }

        Container::put('laravel.version', $version);

        // Install Application class stub
        @unlink($this->laravelFrameworkPath);
        symlink(
            $this->fixturePath("stubs/laravel/{$version}/framework"),
            $this->laravelFrameworkPath
        );

        // Set the logger instance into the container
        $loggerClass = $version < '5.6'
            ? \Illuminate\Log\Writer::class
            : \Illuminate\Log\Logger::class;
        Container::put('log', new $loggerClass(new \Monolog\Logger('')));
    }

    /** @after */
    public function turnLaravelOff()
    {
        // Uninstall Application
        @unlink($this->laravelFrameworkPath);

        Container::flush();
    }
}
