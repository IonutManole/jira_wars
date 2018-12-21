<?php

namespace App\Repositories;


use App\Models\Teams;

class TeamsRepository extends AbstractEloquentRepository
{
    /**
     * @var Teams
     */
    protected $model;
    protected function getTableName(): string
    {
        return 'team';
    }

    protected function getModelClass(): string
    {
        return Teams::class;
    }

    /**
     * LinePlanRepository constructor.
     * @param Teams $teams
     */
    public function __construct(Teams $teams)
    {
        $this->model = $teams;
    }
}
