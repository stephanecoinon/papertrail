<?php

// Stub for Illuminate/Support/helpers.php

if (! function_exists('app')) {
    /**
	 * Get the root Facade application instance.
	 *
	 * @param  string  $make
	 * @return mixed
	 */
	function app($make = null)
    {
        // In all the tests, we're only interested in resolving the logger
        $laravelVersion = \Tests\Support\Container::get('laravel.version');
        $loggerClass = $laravelVersion < '5.6'
            ? \Illuminate\Log\Writer::class
            : \Illuminate\Log\Logger::class;

        return new $loggerClass(new \Monolog\Logger(''));
    }
}
