<?php

namespace App\CampReservationSystem\Impl;

use App\CampReservationSystem\Camp;
use App\CampReservationSystem\CampFinderInterface;
use App\CampReservationSystem\CampId;

class CampFinder implements CampFinderInterface
{
    public function __construct(private ClientInterface $client){
    }
    /**
     * @inheritDoc
     */
    public function findCamp(CampId $id): ?Camp
    {
        return $this->client
        ->getCamps()
        ->filter(fn(Camp $camp)=>$camp->equalsId($id))
        ->getOrElse(null);
    }
}
