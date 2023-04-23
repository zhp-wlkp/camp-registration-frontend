<?php

namespace App\CampRegistrationSystem;

use App\CampRegistrationSystem\Camp\Team;

class Camp
{
    /**
     * @var Team[]
     */
    private array $teams = [];
    public function __construct(
        private CampId $campId,
        private string $internalCampId,
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

    public function addTeam(Team $team): void
    {
        $this->teams[] = $team;
    }

    /**
     * @return Team[]
     */
    public function getTeams(): array
    {
        return $this->teams;
    }

    public function getInternalCampId(): string
    {
        return $this->internalCampId;
    }
}
