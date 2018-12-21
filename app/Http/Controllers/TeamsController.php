<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTeamHelpRequest;
use App\Repositories\TeamsRepository;
use App\Services\TeamHelpService;
use App\Transformers\GetTeamsTransformer;
use App\Transformers\TeamHelpTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class TeamsController
{
    public function index(
        TeamsRepository $teamsRepository,
        GetTeamsTransformer $getTeamsTransformer
    ) {
        try {
            $teams = $teamsRepository->findAll();

            return new JsonResponse(
                $getTeamsTransformer->transformCollection($teams),
                Response::HTTP_OK
            );
        } catch (\Exception $exception) {
            Log::error($exception->getMessage(), [$exception->getTraceAsString()]);
            return new JsonResponse('Could not find team', Response::HTTP_NOT_FOUND);
        }
    }

    public function store(
        UpdateTeamHelpRequest $updateTeamHelpRequest,
        TeamHelpService $teamHelpService,
        TeamHelpTransformer $teamHelpTransformer
    ) {
        $teamId = $updateTeamHelpRequest->get('team_id');
        $receiveTeamId = $updateTeamHelpRequest->get('receive_team_id');
        try {
            $teamHelp = $teamHelpService->create($teamId, $receiveTeamId);

            return new JsonResponse(
                $teamHelpTransformer->transform($teamHelp),
                Response::HTTP_CREATED
            );

        } catch (\Exception $exception) {
            Log::error($exception->getMessage(), [$exception->getTraceAsString()]);
            return new JsonResponse('Could not save the request for help', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
