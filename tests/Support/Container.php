<?php

namespace Tests\Support;

class Container
{
    /**
     * Values bound into the container.
     *
     * @var mixed[]
     */
    protected static $bindings = [];

    public static function has($key)
    {
        return isset(static::$bindings[$key]);
    }

    public static function put($key, $value)
    {
        static::$bindings[$key] = $value;
    }

    public static function get($key, $default = null)
    {
        return static::has($key) ? static::$bindings[$key] : $default;
    }

    public static function delete($key)
    {
        if (static::has($key)) {
            unset(static::$bindings[$key]);           
        }
    }
}