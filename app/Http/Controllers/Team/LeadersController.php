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
        $teams = Team::orderBy('scores', 'DESC')->take(10)->get();
        foreach($teams as $team){
            $user = User::where('id', $team->creator_id)->first();
            $team['photo']=$user->photo;

        }
        return $teams;
    }

}
