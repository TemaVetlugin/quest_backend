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

class QuestIdController extends Controller
{
    public function __invoke(Request $request)
    {

        $key = $request->input('key');
        $task = Task::where('key', $key)->first();

        return response($task->quest_id, Response::HTTP_OK);
    }

}
