<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamHelp extends Model
{
    protected $fillable = [
        'id',
        'team_id',
        'receive_team_id',
        'accepted',
        'issue'
    ];

}
