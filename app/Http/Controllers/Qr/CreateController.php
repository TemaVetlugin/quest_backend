<?php

namespace App\Http\Controllers\Qr;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\Team;
use App\Models\Task;
use App\Models\User;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CreateController extends Controller
{
    public function __invoke()
    {
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
        $path = env('APP_URL') . '/task/';
        $writer = new PngWriter();
        $qrCode = QrCode::create("{$path}".$key)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
        $result = $writer->write($qrCode);
        header('Content-Type: '.$result->getMimeType());
        $data['qr']=$result->getDataUri();
        return $data;
    }
}
