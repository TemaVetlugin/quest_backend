<?php

namespace App\Http\Controllers\Team\Quest;

use App\Http\Controllers\Controller;
use App\Models\Quest;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Response;

class QuestCancelController extends Controller
{
    public function __invoke(Quest $quest)
    {
        $user=auth()->user();
        $team = Team::where('id', $user->team_id)->first();
        $team_id = $team->id;
        if (!$team->quests()->wherePivot('quest_id', $quest->id)->exists()) {
            return response('Вы не участвуете в этом квесте', Response::HTTP_OK);
        }

        $team->quests()->detach($quest->id);
        if($team_id) {
            User::where(['team_id' => $team_id])->update(['task_id' => null]);
            $data['started_at']=null;
            $data['quest_scores']=0;
            $data['hints']=0;
            $team->update($data);
        }
        return response('Квест отменен', Response::HTTP_OK);
    }
}
