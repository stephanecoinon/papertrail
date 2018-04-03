<?php

if (! function_exists('dump')) {
    /**
     * Dump the passed variables.
     *
     * @param  mixed  $args
     * @return void
     */
    function dump(...$args)
    {
        var_dump($args);
        ob_flush();
    }
}

if (! function_exists('dd')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed  $args
     * @return void
     */
    function dd(...$args)
    {
        http_response_code(500);
        var_dump($args);
        die(1);
    }
}
