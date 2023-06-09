<?php

namespace App\CampRegistrationSystem;


interface CampFinderInterface{
    /**
     * Finds Camp in the system.
     *
     * @param CampId $id
     * @return Camp|null
     */
    public function findCamp(CampId $id):?Camp;
}