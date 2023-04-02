<?php

namespace App\CampReservationSystem\Impl;
use App\CampReservationSystem\Camp;
use Munus\Collection\Stream;

interface ClientInterface{
    /**
     * Undocumented function
     *
     * @return Stream<Camp>
     */
    public function getCamps():Stream;
}