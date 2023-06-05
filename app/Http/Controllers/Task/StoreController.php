<?php

namespace App\Http\Controllers\Task;

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
                $data = json_decode($taskData, true);

                if (array_key_exists($i, $file_to_task)) {
                    $data['file'] = $file_to_task[$i];
                }
                $new_task = Task::create($data);



                $task_ids[$i] = $new_task->id;
                $i++;
            }
        }

        $data['task_ids']=$task_ids;

        return $data;
    }

}
