<?php

namespace App\Http\Controllers\Quest;

use App\Http\Controllers\Controller;
use App\Models\Quest;

class QuestShowController extends Controller
{
    public function __invoke(Quest $quest)
    {

        $tasks=$quest->tasks;
        foreach($tasks as $task){
            $categories=$task->categories;
            $task['categories']=$categories;
        }
        $quest['tasks']=$tasks;
//        dd($categories);
        return $quest;
    }
}
