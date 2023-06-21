<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\Team;
use App\Models\User;

class StartedController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $team = Team::where('id', $user->team_id)->first();
        $data['started_at'] = $team->started_at;
        $data['hints'] = $team->hints;
        return $data;
    }

}
