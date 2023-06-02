<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Response;

class EditController extends Controller
{
    public function __invoke(Task $task)
    {
        $categories=$task->categories;
        $task['categories']=$categories;
        return response($task, Response::HTTP_OK);
    }
}
