<?php

// Stub for Illuminate/Support/helpers.php

use Tests\Support\Container;

if (! function_exists('app')) {
    /**
	 * Get the root Facade application instance.
	 *
	 * @param  string  $make
	 * @return mixed
	 */
	function app($make = null)
    {
        if (! Container::has('laravel.version')) {
            return;
        }

        return Container::get($make);
    }
}
