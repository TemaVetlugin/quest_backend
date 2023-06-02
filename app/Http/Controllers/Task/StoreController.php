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
        $path = env('APP_URL') . '/task/';
        $i = 0;
        $file_to_task = [];
        $task_ids = [];
        $tasksData = $request->input('tasks');
        $filesData = [];
        $writer = new PngWriter();
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
                if (array_key_exists($i, $file_to_task)) {
                    $data['file'] = $file_to_task[$i];
                }
                $new_task = Task::create($data);


                $qrCode = QrCode::create("{$path}".$new_task->key)
                    ->setEncoding(new Encoding('UTF-8'))
                    ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
                    ->setSize(300)
                    ->setMargin(10)
                    ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
                    ->setForegroundColor(new Color(0, 0, 0))
                    ->setBackgroundColor(new Color(255, 255, 255));
                $result = $writer->write($qrCode);
                header('Content-Type: '.$result->getMimeType());
                $qrs[$i]=$result->getDataUri();
                $task_ids[$i] = $new_task->id;
                $i++;
            }
        }

        $data['qrs']=$qrs;
        $data['task_ids']=$task_ids;

        return $data;
    }

}
