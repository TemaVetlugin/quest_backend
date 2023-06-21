<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PhotoStoreRequest;
use App\Models\Task;
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
        $task = Task::where('key', $task_key)->first();
        if ($user->task_id == $task_key) {
            if($user->started_at==null) {
                $user->update(['started_at' => now()]);
            }
            else{
                $message = 'Вы уже начали это задание';
                return response($message, Response::HTTP_OK);
            }
        } else {
            $message = 'Вы еще не разблокировали это задание';
            return response($message, Response::HTTP_OK);
        }
        return response($task->quest_id, Response::HTTP_OK);
    }

}
