<?php

namespace App\Repositories;

use App\Models\TeamHelp;

class TeamHelpRepository extends Repository
{
    /**
     * @var TeamHelp
     */
    protected $model;
    protected function getTableName(): string
    {
        return 'team';
    }

    protected function getModelClass(): string
    {
        return TeamHelp::class;
    }

    /**
     * LinePlanRepository constructor.
     * @param TeamHelp $teamHelp
     */
    public function __construct(TeamHelp $teamHelp)
    {
        $this->model = $teamHelp;
    }
}
