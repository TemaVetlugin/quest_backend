<?php

namespace App\Http\Controllers\Quest;

use App\Http\Controllers\Controller;
use App\Models\Quest;
use App\Models\Team;

class QuestShowController extends Controller
{
    public function __invoke(Quest $quest)
    {
        $user=auth()->user();
        $team=Team::where('id', $user->team_id)->first();
        $quest['user_hints']=$user->hint;
        $quest['team_hints'] = $team->hints;
        $tasks=$quest->tasks;
        foreach($tasks as $task){
            $categories=$task->categories;
            $task['categories']=$categories;
        }
        $quest['tasks']=$tasks;
//        dd($categories);
        return $quest;
    }
}
