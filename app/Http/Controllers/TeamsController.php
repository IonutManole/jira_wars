<?php

namespace App\Http\Controllers;

use App\Repositories\TeamsRepository;
use App\Transformers\GetTeamsTransformer;
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
}
