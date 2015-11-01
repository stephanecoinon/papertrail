<?php

use StephaneCoinon\Papertrail\Spec\Helpers\PapertrailHttpApiClient;

describe('Test all implementations', function () {

    $implementations = [
        StephaneCoinon\Papertrail\Base::class,
        StephaneCoinon\Papertrail\Laravel4::class,
        StephaneCoinon\Papertrail\Laravel5::class,
    ];

    before(function () {
        $this->host = getenv('PAPERTRAIL_HOST');
        $this->port = getenv('PAPERTRAIL_PORT');
        $this->papertrailClient = new PapertrailHttpApiClient(getenv('PAPERTRAIL_API_TOKEN'));
    });

    // test one implementation
    function testImplementation($implementation)
    {
        it('can boot using given papertrail log host and port', function () use ($implementation) {
            $logger = $implementation::boot($this->host, $this->port);

            $message = 'this is a test log message';
            $logger->info($message);

            expect($this->papertrailClient->getLastEvent()->message)
                ->toContain($message);
        });

        it('can boot using given log message prefix', function () use ($implementation) {
            $prefix = '@PREFIX@';
            $logger = $implementation::bootWithPrefix($prefix);

            $message = 'this is a test log message';
            $logger->info($message);

            $actualMessage = $this->papertrailClient->getLastEvent()->message;
            expect($actualMessage)->toContain("[$prefix]");
            expect($actualMessage)->toContain($message);
        });
    }

    // test all implementations
    array_walk($implementations, function ($implementation) {
        testImplementation($implementation);
    });
});
