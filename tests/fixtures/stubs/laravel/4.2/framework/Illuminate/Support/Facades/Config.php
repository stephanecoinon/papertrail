<?php

namespace Illuminate\Support\Facades;

use Tests\Support\Container;

class Config
{
    public static function get($key, $default = null)
    {
        $config = Container::get('config', []);

        return $config[$key] ?? $default;
    }
}