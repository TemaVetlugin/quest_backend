<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StartTaskController extends Controller
{
    public function __invoke(  Request $request)
    {
        $task_key= $request->input('task_key');
        $user=auth()->user();
        $team_id=$user->team_id;
        if($team_id) {
            User::where(['team_id' => $team_id])->update(['task_id' => $task_key]);
            return response(['Новое задание']);
        }
        else{
            return response(['Вы не состоите в команде']);
        }
    }

}
