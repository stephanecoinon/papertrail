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
        return new \Illuminate\Log\Writer(new \Monolog\Logger(''));
    }
}
