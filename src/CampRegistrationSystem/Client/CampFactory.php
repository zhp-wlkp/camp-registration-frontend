<?php

namespace App\CampRegistrationSystem\Client;

use App\CampRegistrationSystem\Camp;
use App\CampRegistrationSystem\Camp\Team;
use App\CampRegistrationSystem\CampId;

class CampFactory
{
    public function create(array $record): Camp
    {
        $camp =  new Camp(new CampId(sha1($record['id'])), $record['id'], $record['name']);
        foreach ($record['teams'] as $team) {
            $camp->addTeam(new Team($team['Value']));
        }
        return $camp;
    }
}
