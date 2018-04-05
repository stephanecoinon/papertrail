<?php

namespace Illuminate\Log;

use Psr\Log\LoggerInterface;

class Logger
{
    /**
     * The underlying logger implementation.
     *
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * The event dispatcher instance.
     *
     * @var \Illuminate\Contracts\Events\Dispatcher
     */
    protected $dispatcher;

    /**
     * Create a new log writer instance.
     *
     * @param  \Psr\Log\LoggerInterface  $logger
     * @param  \Illuminate\Contracts\Events\Dispatcher|null  $dispatcher
     * @return void
     */
    public function __construct(LoggerInterface $logger, $dispatcher = null)
    {
        $this->logger = $logger;

        if (isset($dispatcher)) {
            $this->dispatcher = $dispatcher;
        }
    }

    /**
     * Get the underlying logger implementation.
     *
     * @return \Psr\Log\LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }
}