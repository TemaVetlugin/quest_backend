<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Http\Resources\News\NewsResource;
use App\Models\News;

class IndexController extends Controller
{
    public function __invoke()
    {
        $news=News::orderBy('id', 'DESC')->get();
        return NewsResource::collection($news);
    }

}
