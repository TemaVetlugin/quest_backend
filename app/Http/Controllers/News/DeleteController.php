<?php

namespace App\Http\Controllers\News;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class DeleteController extends Controller
{
    public function __invoke( News $news)
    {
        Storage::disk('public')->delete($news['file']);
        $news->delete();
        return response('Новость удалена', Response::HTTP_OK);
    }
}
