<?php

namespace App\CampRegistrationSystem\Impl;

use App\CampRegistrationSystem\Camp;
use App\CampRegistrationSystem\CampFinderInterface;
use App\CampRegistrationSystem\CampId;

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
