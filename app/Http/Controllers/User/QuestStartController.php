<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Quest;
use Illuminate\Http\Response;

class QuestStartController extends Controller
{
    public function __invoke(Quest $quest)
    {
        $user=auth()->user();
        if ($user->quests()->wherePivot('quest_id', $quest->id)->exists()) {
            return response('Вы уже прошли этот квест', Response::HTTP_OK);
        }
        if($user->task_id!==null){
            return response('Сначала закончите текущий квест', Response::HTTP_OK);
        }
        $user->quests()->attach($quest->id, ['mode' => 0]);

        return response('Вы начали квест', Response::HTTP_OK);;
    }
}
