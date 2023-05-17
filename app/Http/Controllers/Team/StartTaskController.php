<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StartTaskController extends Controller
{
    public function __invoke(  Request $request)
    {
        $task_key= $request->input('task_key');
        $team_id=$request->input('team_id');
        $team = Team::where('id', $team_id)->first();
        $team->update(['task_id' => $task_key]);
//        dd($hints);
        return response([]);
    }

}
