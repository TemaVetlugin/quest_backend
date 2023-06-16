<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Quest;
use Illuminate\Http\Response;

class QuestCancelController extends Controller
{
    public function __invoke(Quest $quest)
    {
        $user=auth()->user();
        if (!$user->quests()->wherePivot('quest_id', $quest->id)->exists()) {
            return response('Вы не участвуете в этом квесте', Response::HTTP_OK);
        }
        $user->quests()->detach($quest->id);
        $data['task_id']=null;
        $data['started_at']=null;
        $data['quest_scores']=0;
        $data['hints']=0;

        $user->update($data);
        return response('Квест отменен', Response::HTTP_OK);
    }
}
