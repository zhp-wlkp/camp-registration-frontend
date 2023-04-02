<?php

namespace App\CampReservationSystem\Camp;

class Team
{
    public function __construct(private string $name)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }
}
