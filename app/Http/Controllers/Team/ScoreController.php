<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Response;

class ScoreController extends Controller
{
    public function __invoke()
    {
//        dd(1111);
        $user_auth = auth()->user();
        $team_id=$user_auth->team_id;
        if($team_id) {
            $user_team = Team::where('id', $user_auth->team_id)->first();
            $creator = User::where('id', $user_team->creator_id)->first();
            $data['scores'] = $user_team->scores;
            $data['title'] = $user_team->title;
            $data['photo'] = $creator->photo;
            $teams = Team::orderBy('scores', 'DESC')->get();

            $index = $teams->search(function ($team) use ($team_id) {
                return $team->id == $team_id;
            });
            $data['place'] = $index + 1; // добавляем 1, потому что индексы начинаются с 0

            return $data;
        }
        else{
            return response('Вы не состоите в команде', Response::HTTP_OK);
        }
    }

}
