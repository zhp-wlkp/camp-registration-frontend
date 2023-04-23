<?php

namespace App\CampRegistrationSystem\Impl;

use App\CampRegistrationSystem\RegistrationData;
use App\CampRegistrationSystem\RegistrationServiceInterface;
use Exception;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

class RegistrationService implements RegistrationServiceInterface, LoggerAwareInterface
{
    private ?LoggerInterface $logger = null;

    public function __construct(private ClientInterface $client)
    {
    }
    /**
     * Makes registration
     *
     * @param RegistrationData $data
     * @return bool
     */
    public function register(RegistrationData $data): bool
    {
        try {
            $this->client->register($data);
            return true;
        } catch(Exception $e) {
            $this->logger && $this->logger->critical("Error during registration.", [
                'error'=>$e
            ]);
            $this->client->reportError($e);
            return false;
        }
    }

    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }
}
