<?php

namespace App\CampReservationSystem\Impl;

use App\CampReservationSystem\Camp;
use App\CampReservationSystem\CampFinderInterface;
use Symfony\Component\Uid\Uuid;

class SharepointCampFinder implements CampFinderInterface
{
    /**
     * @inheritDoc
     */
    public function findCamp(Uuid $id): ?Camp
    {
        return null;
    }
}
