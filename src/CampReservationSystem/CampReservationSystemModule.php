<?php

namespace App\CampReservationSystem;

use Symfony\Component\Uid\Uuid;

/**
 * Facade for the module.
 */
class CampReservationSystemModule
{
    public function __construct(
        private CampFinderInterface $campFinder
    ) {
    }
    public function findCamp(Uuid $uid): ?Camp
    {
        return $this->campFinder->findCamp($uid);
    }
}
