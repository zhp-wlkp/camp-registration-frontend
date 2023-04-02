<?php

namespace App\CampReservationSystem;

/**
 * Facade for the module.
 */
class CampReservationSystemModule
{
    public function __construct(
        private CampFinderInterface $campFinder
    ) {
    }
    public function findCamp(CampId $id): ?Camp
    {
        return $this->campFinder->findCamp($id);
    }
}
