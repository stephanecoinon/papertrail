<?php

namespace Illuminate\Log;

use Monolog\Logger as MonologLogger;

class Writer
{
	/**
	 * The Monolog logger instance.
	 *
	 * @var \Monolog\Logger
	 */
	protected $monolog;

	/**
	 * The event dispatcher instance.
	 *
	 * @var \Illuminate\Events\Dispatcher
	 */
	protected $dispatcher;

	/**
	 * Create a new log writer instance.
	 *
	 * @param  \Monolog\Logger  $monolog
	 * @param  \Illuminate\Events\Dispatcher  $dispatcher
	 * @return void
	 */
	public function __construct(MonologLogger $monolog, $dispatcher = null)
	{
		$this->monolog = $monolog;
		
		if (isset($dispatcher))
		{
			$this->dispatcher = $dispatcher;
		}
	}

	/**
	 * Get the underlying Monolog instance.
	 *
	 * @return \Monolog\Logger
	 */
	public function getMonolog()
	{
		return $this->monolog;
	}
}
