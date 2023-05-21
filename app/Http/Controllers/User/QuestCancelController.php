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
        $user->update(['task_id' => null]);
        return response('Квест отменен', Response::HTTP_OK);
    }
}
