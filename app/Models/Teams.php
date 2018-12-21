<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    protected $fillable = [
        'id',
        'team_name',
        'team_description',
        'image'
    ];
}
