<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\Team;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(Team $team)
    {
        $users=$team->users;
        $team = Team::with(['quests'=>function($query){
            $query->withPivot(['mode', 'time'])->orderBy('id');
        }])->find($team->id);
        $team['users']=$users;

        return $team;
    }
}
