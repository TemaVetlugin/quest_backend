<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Task;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Team $team)
    {
        $tasks=$team->tasks;
        foreach($tasks as $task){
            $hints=$task->hints;
            $task['hints']=$hints;
        }
        $team['tasks']=$tasks;
//        dd($hints);
        return $team;
    }
}
