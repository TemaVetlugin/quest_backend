<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(Request $request, Task $task)
    {
        $data=$request->input();
        $task->update($data);
        return response('Задание изменено', Response::HTTP_OK);
    }
}
