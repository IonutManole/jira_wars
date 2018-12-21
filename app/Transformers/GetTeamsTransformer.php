<?php

namespace App\Transformers;

class GetTeamsTransformer
{
    public function transform($item):array
    {
        if (is_null($item)) {
            return [];
        }

        $team = [
            'id' => $item->id,
            'team_name' => $item->teamName,
            'team_description' => $item->teamDescription,
        ];

        return $team;
    }

    public function transformCollection($items)
    {
        if (is_null($items)) {
            return [];
        }

        $teams = [];

        foreach ($items as $item) {
            $team = [
                'id' => $item->id,
                'team_name' => $item->team_name,
                'team_description' => $item->team_description,
                'image' => $item->image
            ];

            array_push($teams, $team);
        }

        return $teams;

    }
}
