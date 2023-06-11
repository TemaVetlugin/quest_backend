<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\Team;
use App\Models\User;

class ScoreController extends Controller
{
    public function __invoke()
    {
        $user_auth = auth()->user();
        $team_id=$user_auth->team_id;
        $user_team=Team::where('creator_id', $user_auth->id)->first();
        $data['scores']=$user_team->scores;
        $data['title']=$user_team->title;
        $teams = Team::orderBy('scores', 'DESC')->get();

        $index = $teams->search(function ($team) use ($team_id) {
        return $team->id == $team_id;
        });
        $data['place'] = $index + 1; // добавляем 1, потому что индексы начинаются с 0

        return $data;
    }

}
