<?php

namespace App\Http\Controllers\Team\Quest;

use App\Http\Controllers\Controller;
use App\Models\Quest;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Response;

class QuestShowController extends Controller
{
    public function __invoke(Quest $quest)
    {
        $user=auth()->user();
        $team = Team::where('id', $user->team_id)->first();
        $team_units = User::where('team_id', $user->team_id)->get();
        foreach ($team_units as $unit){
            if($unit->task_id!==null){
                return response('Некоторые участники команды участвуют в квесте', Response::HTTP_OK);
            }
        }
        if(!$team){
            return response('Вы не состоите в команде', Response::HTTP_OK);
        }
        if($team->creator_id!==$user->id){
            return response('Только капитан команды может начать квест', Response::HTTP_OK);;
        }
        if ($team->quests()->wherePivot('quest_id', $quest->id)->exists()) {
            return response('Вы уже прошли этот квест', Response::HTTP_OK);
        }

        $team->quests()->attach($quest->id, ['mode' => 0]);

        return response('Вы начали квест', Response::HTTP_OK);;
    }
}
