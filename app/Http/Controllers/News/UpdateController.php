<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(Request $request, News $news)
    {
        $newsData = $request->input('news');
        $data = json_decode($newsData, true);
        if($request->file('file')){
            $file=$request->file('file');
            if (Storage::disk('public')->exists($news['file'])) {
                // Удаляем файл
                Storage::disk('public')->delete($news['file']);
            }
            $data['file'] = Storage::disk('public')->put('/news', $file);
        }
        $news->update($data);
        return response('Новость изменена', Response::HTTP_OK);
    }
}
