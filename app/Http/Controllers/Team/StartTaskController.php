<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class StartTaskController extends Controller
{
    public function __invoke(  Request $request)
    {
        $task_key= $request->input('task_key');
        $user=auth()->user();
        $team_id=$user->team_id;
        $task = Task::where('key', $user->task_id)->first();
        $new_task = Task::where('key', $task_key)->first();

        $team = Team::where('id', $team_id)->first();
        $scores = $team->quest_scores;
        if($team_id) {
            if ($user->task_id !== null) {
                $categories = $task->categories;

                $startDate = Carbon::parse($team->started_at);
                $endDate = Carbon::parse(now());
                $diffInMinutes = $startDate->diffInMinutes($endDate);
                $scores = $team->quest_scores;
                foreach ($categories as $category) {
//                $categoryDif = $category->time / $diffInMinutes;
                    if ($category->time <= $diffInMinutes) {
                        $scores -= $category->scores;
//                        dd($scores);
                    }
                }
//                dd($scores);
//            dd($scores);
                $data['quest_scores'] = $scores;
                $data['hints']=0;
                if($task_key==null){
//                    $data['task_id']=null;
                    User::where(['team_id' => $team_id])->update(['task_id' => null]);
                    $team->update($data);
                    return response('Вы закончили задание', Response::HTTP_OK);
                }

            }
            if($new_task->qr=='0') {
                $data['started_at'] = now();
            }
            $data['quest_scores'] = $scores+$new_task->scores;
            User::where(['team_id' => $team_id])->update(['task_id' => $task_key]);
            $team->update($data);
//        dd($hints);
            return response('Вы начали задание', Response::HTTP_OK);


        }
        else{
            return response('Вы не состоите в команде', Response::HTTP_OK);
        }

    }

}
