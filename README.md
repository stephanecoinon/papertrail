# Papertrail PHP Connector

[![Build Status](https://travis-ci.org/stephanecoinon/papertrail.svg?branch=master)](https://travis-ci.org/stephanecoinon/papertrail) [![License](https://poser.pugx.org/stephanecoinon/papertrail/license.svg)](https://packagist.org/packages/stephanecoinon/papertrail)

Easily integrate [Papertrail log monitor](https://papertrailapp.com) in your PHP applications. This package provides integration for plain vanilla PHP and Laravel.

## Installation

```bash
composer require stephanecoinon/papertrail
```

## Configuration

It is good practice *not* to include credentials in your code so passwords are not stored in version control. Keeping sensitive info in your code could become an issue when you need to open source or share your code with other developers. For this reason, this package will get your papertrail log server details from environment variables `PAPERTRAIL_HOST` and `PAPERTRAIL_PORT` by default.

This package ships with 2 drivers:

- `Php` for plain PHP applications
- `Laravel` for Laravel applications from version 4.2 to 5.6

### Plain Vanilla PHP

For plain PHP applications, we recommend also installing [Monolog](https://github.com/Seldaek/monolog):

```bash
composer require monolog/monolog
```

then integrate the papertrail package like so:

```php
require __DIR__ . '/vendor/autoload.php';

use StephaneCoinon\Papertrail\Php as Papertrail;

// Boot using default settings (ie Papertrail log server and port
// from environment variables and no log message prefix).
// It also gives you a monolog instance in the process.
$logger = Papertrail::boot();

// Now your logs will appear in Papertrail dashboard.
$logger->info('test log');
```

### Laravel 4
Add these lines in your `start/global.php`:

```php
// Pass all parameters
\StephaneCoinon\Papertrail\Laravel::boot($host, $port, $prefix);
```

or

```php
// Grab log server details from environment variables and use a prefix
\StephaneCoinon\Papertrail\Laravel::bootWithPrefix('MY_APP');
```


### Laravel 5
Edit `app/Providers/AppServiceProvider.php` and add this line in `boot` method:

```php
\StephaneCoinon\Papertrail\Laravel::boot();
```

then test it's working:

```php
// routes/web.php

Route::get('log', function () {
    Log::info('test log', ['foo' => 'bar']);

    return 'Logged';
});

```


## API reference

All drivers provide the following interface:

```php
/**
 * Boot connector with given host, port and log message prefix.
 * 
 * If host or port are omitted, we'll try to get them from the environment
 * variables PAPERTRAIL_HOST and PAPERTRAIL_PORT.
 * 
 * @param  string $host   Papertrail log server, ie log.papertrailapp.com
 * @param  int $port      Papertrail port number for log server
 * @param  string $prefix Prefix to use for each log message
 * @return \Psr\Log\LoggerInterface
 */
public static function boot($host = null, $port = null, $prefix = '')
```

```php
/**
 * Boot connector using credentials set in environment variables and the
 * given log message prefix.
 * 
 * @param string $prefix Prefix to use for each log message
 * @return \Psr\Log\LoggerInterface
 */
public static function bootWithPrefix($prefix)
```

## Tests

First, copy `.env.dist` as `.env` and set your Papertrail host, port and API key in it.

Then run PHPUnit:

```bash
./vendor/bin/phpunit
```
