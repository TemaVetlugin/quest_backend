<?php

namespace App\Http\Controllers\Task;

use App\Models\Category;
use App\Models\Task;
use App\Models\Team;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function __invoke(Request $request)
    {

        $i = 0;
        $file_to_task = [];
        $task_ids = [];
        $tasksData = $request->input('tasks');
        $categoriesData = $request->input('categories');
        $filesData = [];
        if ($request->file('files')) {
            foreach ($request->file('files') as $index => $file) {
                if ($file->isValid()) {
                    $filesData[$index] = $file;
                    $file_to_task[$index] = Storage::disk('public')->put('/tasks', $file);
                }
            }
        }
//        dd($file_to_task);
        if ($tasksData) {
            foreach ($tasksData as $taskData) {
                $data = $taskData;
//                $data = json_decode($taskData, true);
                if (array_key_exists($i, $file_to_task)) {
                    $data['file'] = $file_to_task[$i];
                }
                $new_task = Task::create($data);

                foreach ($categoriesData as $categoryData) {
//                    $data = json_decode($categoryData, true);
                    $data = $categoryData;
                    if($data['task_id']==$i){
//                        dd($i);
                        $data['task_id']=$new_task->id;
                        $new_category=Category::create($data);
                    }
                }


//                $task_ids[$i] = $new_task->id;
                $i++;
            }
        }

//        $data['task_ids']=$task_ids;

        return response('Задания добавлены', Response::HTTP_OK);
    }

}
