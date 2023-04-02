<?php

namespace App\CampReservationSystem;

class Camp
{
    public function __construct(
        private CampId $campId,
        private string $name
    ) {
    }


    public function equalsId(CampId $id): bool
    {
        return $this->campId->equals($id);
    }

    public function getName(): string
    {
        return $this->name;
    }
}
