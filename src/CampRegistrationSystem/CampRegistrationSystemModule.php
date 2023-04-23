<?php

namespace App\CampRegistrationSystem;

/**
 * Facade for the module.
 */
class CampRegistrationSystemModule
{
    public function __construct(
        private CampFinderInterface $campFinder,
        private RegistrationServiceInterface $service,
    ) {
    }
    public function findCamp(CampId $id): ?Camp
    {
        return $this->campFinder->findCamp($id);
    }

    public function register(RegistrationData $data): bool
    {
        return $this->service->register($data);
    }
}
