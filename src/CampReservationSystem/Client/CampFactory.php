<?php

namespace App\CampReservationSystem\Client;

use App\CampReservationSystem\Camp;
use App\CampReservationSystem\Camp\Team;
use App\CampReservationSystem\CampId;

class CampFactory
{
    public function create(array $record): Camp
    {
        $camp =  new Camp(new CampId(sha1($record['id'])), $record['name']);
        foreach ($record['teams'] as $team) {
            $camp->addTeam(new Team($team['Value']));
        }
        return $camp;
    }
}
