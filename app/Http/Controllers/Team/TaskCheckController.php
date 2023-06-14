<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PhotoStoreRequest;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class TaskCheckController extends Controller
{
    public function __invoke(Request $request)
    {
        $task_key = $request->input('qrKey');
        $user = auth()->user();
        $team = Team::where('id', $user->team_id)->first();
        $task = Task::where('key', $task_key)->first();
        if ($user->task_id == $task_key) {
            if($team->creator_id==$user->id){
                $team->update(['started_at'=>now()]);
            }
            else{
                $message = 'Вы не являетесь капитаном команды';
                return response($message, Response::HTTP_OK);
            }
        } else {
            $message = 'Вы еще не разблокировали это задание';
            return response($message, Response::HTTP_OK);
        }
        return response($task->quest_id, Response::HTTP_OK);
    }

}
