<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/teams', [
    'uses' => 'TeamsController@index',
]);

Route::post('/help', [
    'uses' => 'TeamsController@store'
]);

Route::get('/help_request/5', function () {
    return [
        [
            'id' => 1,
            'team_name' => 'Logistics',
            'receive_team_name' => 'Product',
            'accepted' => true,
            'issue' => 'LOG-123'
        ],
        [
            'id' => 2,
            'team_name' => 'Product',
            'receive_team_name' => 'Sigma',
            'accepted' => true,
            'issue' => 'PCT-223'
        ],
        [
            'id' => 3,
            'team_name' => 'Sigma',
            'receive_team_name' => 'Logistics',
            'accepted' => true,
            'issue' => 'SIG-554'
        ]
    ];
});
