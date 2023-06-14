<?php

namespace App\Http\Controllers\Team\Quest;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PhotoStoreRequest;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class QuestDoneController extends Controller
{
    public function __invoke(  Request $request)
    {
        $quest_id= $request->input('quest_id');
        $user=auth()->user();
        $team = Team::where('id', $user->team_id)->first();
        $quest_scores= $team->quest_scores;
        $quest = $team->quests()->wherePivot('quest_id', $quest_id)->withPivot(['created_at', 'time'])->first();
        $startDate = Carbon::parse($quest->pivot->created_at);
        $endDate = Carbon::parse(now());
        $time = $startDate->diffInMinutes($endDate);

        $data['scores']=$team->scores+$quest_scores;
        $data['started_at']=null;
        $data['quest_scores']=0;
        $team->update($data);
        $team->quests()->updateExistingPivot($quest_id, ['mode' => 1, 'time'=>$time, 'scores'=>$quest_scores]);
//        dd($hints);

        return response(['Квест закончен'], Response::HTTP_OK);
    }

}
