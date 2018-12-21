<?php

namespace App\Transformers;

class TeamHelpTransformer
{
    public function transform($item):array
    {
        if (is_null($item)) {
            return [];
        }

        $team = [
            'id' => $item->id,
            'team_id' => $item->team_id,
            'receive_team_id' => $item->receive_team_id,
            'accepted' => $item->accepted,
            'issue' => $item->issue
        ];

        return $team;
    }
}
