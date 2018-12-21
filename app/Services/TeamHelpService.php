<?php

namespace App\Services;

use App\Models\TeamHelp;
use App\Repositories\TeamHelpRepository;

class TeamHelpService
{
    protected $teamHelpRepository;

    public function __construct(TeamHelpRepository $teamHelpRepository)
    {
        $this->teamHelpRepository = $teamHelpRepository;
    }

    public function create(int $teamId, int $receiveTeamId):TeamHelp
    {
        $teamHelp = $this->teamHelpRepository->create(
            [
                'team_id' => $teamId,
                'receive_team_id' => $receiveTeamId,
            ]
        );

        return $teamHelp;
    }
}
