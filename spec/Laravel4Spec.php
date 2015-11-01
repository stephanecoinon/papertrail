<?php

use StephaneCoinon\Papertrail\Laravel4 as Papertrail;
use StephaneCoinon\Papertrail\Spec\Helpers\PapertrailHttpApiClient;

describe('Laravel 4 integration', function () {

    before(function () {
        $this->host = getenv('PAPERTRAIL_HOST');
        $this->port = getenv('PAPERTRAIL_PORT');
        $this->papertrailClient = new PapertrailHttpApiClient(getenv('PAPERTRAIL_API_TOKEN'));
    });

    it('can boot using given papertrail log host and port', function () {
        $logger = Papertrail::boot($this->host, $this->port);

        $message = 'this is a test log message';
        $logger->info($message);

        $this->expect($this->papertrailClient->getLastEvent()->message)
            ->toContain($message);
    });

    it('can boot using given log message prefix', function () {
        $prefix = '@PREFIX@';
        $logger = Papertrail::bootWithPrefix($prefix);

        $message = 'this is a test log message';
        $logger->info($message);

        $actualMessage = $this->papertrailClient->getLastEvent()->message;
        $this->expect($actualMessage)->toContain("[$prefix]");
        $this->expect($actualMessage)->toContain($message);
    });

});
