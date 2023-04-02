<?php

namespace App\CampReservationSystem;
use Symfony\Component\Uid\Uuid;


interface CampFinderInterface{
    /**
     * Finds Camp in the system.
     *
     * @param Uuid $uid
     * @return Camp|null
     */
    public function findCamp(Uuid $uid):?Camp;
}