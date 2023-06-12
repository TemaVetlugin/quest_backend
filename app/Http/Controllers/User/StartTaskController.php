<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PhotoStoreRequest;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class StartTaskController extends Controller
{
    public function __invoke(Request $request)
    {
        $task_key = $request->input('task_key');
        $user = auth()->user();
        $task = Task::where('key', $user->task_id)->first();
        if ($user->task_id !== null) {
            $categories = $task->categories;

            $startDate = Carbon::parse($user->started_at);
            $endDate = Carbon::parse(now());
            $diffInMinutes = $startDate->diffInMinutes($endDate);
            $scores = $user->quest_scores;
            foreach ($categories as $category) {
//                $categoryDif = $category->time / $diffInMinutes;
                if ($category->time < $diffInMinutes) {
                    $scores -= $category->scores;
                }
            }
//            dd($scores);
            $data['quest_scores'] = $scores;
            if($task_key==null){

            }

        }
        $new_task = Task::where('key', $task_key)->first();

        if($new_task->qr=='0') {
            $data['started_at'] = now();
        }
        $data['task_id'] = $task_key;
        $data['quest_scores'] = $user->quest_scores+$task->scores;
        $user->update($data);
//        dd($hints);
        return response('Вы начали задание', Response::HTTP_OK);
    }

}
