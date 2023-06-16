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
        $fileQr_to_task = [];
        $task_ids = [];
        $tasksData = $request->input('tasks');
        $categoriesData = $request->input('categories');
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
            $data = json_decode($tasksData, true);
            foreach ($data as $taskData) {
//                $data = $taskData;
                if (array_key_exists($i, $file_to_task)) {
                    $taskData['file'] = $file_to_task[$i];
                }
                if (array_key_exists($i, $fileQr_to_task)) {
                    $taskData['file_qr'] = $fileQr_to_task[$i];
                }
                if(!$data->key) {
                    for ($k = 0; $k < 5; $k++) {
                        $key = Str::random(4);
                        $key_exists = Task::where('key', $key)->first();
                        if ($key_exists) {
                            $k = 0;
                        } else {
                            $k = 5;
                            $data['key'] = $key;
                        }
                    }
                }
                $new_task = Task::create($taskData);

                $data = json_decode($categoriesData, true);
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

        return response('Задания добавлены', Response::HTTP_OK);
    }

}
