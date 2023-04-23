<?php

namespace App\CampRegistrationSystem\Camp;

class Team implements \JsonSerializable
{
    public function __construct(private string $name)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function jsonSerialize()
    {
        return [
            'name'=>$this->name
        ];
    }
}
