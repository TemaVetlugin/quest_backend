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
        if ($user->task_id !== null) {
            $task = Task::where('key', $user->task_id)->first();
            $categories = $task->categories;

            $startDate = Carbon::parse($user->started_at);
            $endDate = Carbon::parse(now());
            $diffInMinutes = $startDate->diffInMinutes($endDate);
            $scores = 0;
            $min_dif = 99999999;
            foreach ($categories as $category) {
                $categoryDif = $category->time / $diffInMinutes;
                if ($categoryDif >= 1 && $categoryDif < $min_dif) {
                    $min_dif = $categoryDif;
                    $scores = $category->scores;
                }
            }
//            dd($scores);
            $data['quest_scores'] = $scores;
        }

        $data['started_at'] = now();
        $data['task_id'] = $task_key;
        $user->update($data);
//        dd($hints);
        return response('Вы начали задание', Response::HTTP_OK);
    }

}
