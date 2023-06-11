<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Resources\Team\TeamResource;
use App\Http\Resources\User\UserResource;
use App\Models\Team;
use App\Models\User;

class LeadersController extends Controller
{
    public function __invoke()
    {
        $roadmaps=Team::orderBy('scores', 'DESC')->get();
        return TeamResource::collection($roadmaps);
    }

}
