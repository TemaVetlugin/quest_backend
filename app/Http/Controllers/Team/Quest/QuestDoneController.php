<?php

namespace App\Http\Controllers\Team\Quest;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PhotoStoreRequest;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestDoneController extends Controller
{
    public function __invoke(  Request $request)
    {
        $quest_id= $request->input('quest_id');
        $time= $request->input('time');
        $quest_scores= $request->input('quest_scores');
        $user=auth()->user();
        $team = Team::where('id', $user->team_id)->first();
        $scores=$user->scores+$quest_scores;
        Team::where(['id' => $user->team_id])->update(['scores' => $scores]);
        $team->quests()->updateExistingPivot($quest_id, ['mode' => 1, 'time'=>$time]);
//        dd($hints);
        return response(['Квест закончен']);
    }

}
