<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdateController extends Controller
{
    public function __invoke(Request $request)
    {
        dd($request->all());
        $i = 0;
        $file_to_task = [];
        $fileQr_to_task = [];
        $task_ids = [];
        $tasksData = $request->input('tasks');
        $categoriesData = $request->input('categories');

        $data =$tasksData;
        $tasksDeleteId = $data[0]['quest_id'];
        $tasksDelete = DB::table('tasks')
            ->where('quest_id', $tasksDeleteId)->get();

        foreach ($tasksDelete as $taskDelete) {
            if ($taskDelete->file) {
                if (Storage::disk('public')->exists($taskDelete->file)) {
                    $delete = 1;
                    // Удаляем файл
                    foreach ($data as $task) {
                        if (isset($task['file'])) {
                            if ($taskDelete->file == $task['file']) {
                                $delete = 0;
                            }
                        }
                    }
                    if ($delete) {
                        Storage::disk('public')->delete($taskDelete->file);
                    }
                }
            }
            if ($taskDelete->file_qr) {
                if (Storage::disk('public')->exists($taskDelete->file_qr)) {
                    $delete_qr = 1;
                    // Удаляем файл
                    foreach ($data as $task) {
                        if (isset($task['file_qr'])) {
                            if ($taskDelete->file_qr == $task['file_qr']) {
                                $delete_qr = 0;
                            }
                        }
                    }
                    if ($delete_qr) {
                        Storage::disk('public')->delete($taskDelete->file_qr);
                    }
                }
            }
            DB::table('categories')
                ->where('task_id', $taskDelete->id)
                ->delete();

        }
        DB::table('tasks')
            ->where('quest_id', $tasksDeleteId)
            ->delete();


        if ($request->file('files')) {
            foreach ($request->file('files') as $index => $file) {
                if ($file->isValid()) {
                    $file_to_task[$index] = Storage::disk('public')->put('/tasks', $file);
                }
            }
        }
        if ($request->file('files_qr')) {
            foreach ($request->file('files_qr') as $index => $file) {
                if ($file->isValid()) {
                    $fileQr_to_task[$index] = Storage::disk('public')->put('/tasks', $file);
                }
            }
        }
//        dd($file_to_task);
        if ($tasksData) {
            $data = $tasksData;
            foreach ($data as $taskData) {
//                $data = $taskData;
                if (array_key_exists($i, $file_to_task)) {
                    $taskData['file'] = $file_to_task[$i];
                }
                if (array_key_exists($i, $fileQr_to_task)) {
                    $taskData['file_qr'] = $fileQr_to_task[$i];
                }
                if(!isset($taskData['key'])) {
                    for ($k = 0; $k < 5; $k++) {
                        $key = Str::random(4);
                        $key_exists = Task::where('key', $key)->first();
                        if ($key_exists) {
                            $k = 0;
                        } else {
                            $k = 5;
                            $taskData['key'] = $key;
                        }
                    }
                }
                $new_task = Task::create($taskData);

                $data = $categoriesData;
                foreach ($data as $categoryData) {
//                    $data = $categoryData;
                    if($categoryData['task_id']==$i){
//                        dd($i);
                        $categoryData['task_id']=$new_task->id;
                        $new_category=Category::create($categoryData);
                    }
                }


//                $task_ids[$i] = $new_task->id;
                $i++;
            }
        }

//        $data['task_ids']=$task_ids;

        return response('Задания обновлены', Response::HTTP_OK);
    }

}


