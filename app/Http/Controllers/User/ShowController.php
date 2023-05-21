<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Quest;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Response;

class ShowController extends Controller
{
    public function __invoke(Quest $quest)
    {
        $user=auth()->user();
        $user = User::with(['quests'=>function($query){
            $query->withPivot(['mode', 'time'])->orderBy('id');
        }])->find($user->id);
        $team = Team::where('id', $user->team_id)->first();
        $team_members=User::where('team_id', $user->team_id)->get();
        $team['users']=$team_members;
        $user['team']=$team;
        return $user;
    }
}
