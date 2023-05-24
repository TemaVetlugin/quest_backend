<?php

namespace App\Http\Controllers\News;

use App\Models\News;
use App\Models\Team;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function __invoke(Request $request)
    {
        $news['content'] = $request->input('content');
        $file=$request->file('file');
        $news['file']=Storage::disk('public')->put('/news', $file);
        News::create($news);

        return response('Новость добавлена', Response::HTTP_OK);
    }

}
