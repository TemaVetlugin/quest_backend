<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\Team;
use App\Models\Task;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(Team $team)
    {
        $users=$team->users;
        $team['users']=$users;

        return $team;
    }
}
