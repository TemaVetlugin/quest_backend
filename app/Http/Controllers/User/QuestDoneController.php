<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PhotoStoreRequest;
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
        $quest_scores= $user->quest_scores;


        $startDate = Carbon::parse($user->started_at);
        $endDate = Carbon::parse(now());
        $time = $startDate->diffInMinutes($endDate);

        $data['scores']=$user->scores+$user->quest_scores;
        $data['started_at']=null;
        $data['task_id']=null;
        $data['quest_scores']=0;
        $user->update($data);
        $user->quests()->updateExistingPivot($quest_id, ['mode' => 1, 'time'=>$time]);
//        dd($hints);
        return response('Квест пройден',Response::HTTP_OK);
    }

}
