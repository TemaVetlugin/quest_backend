<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Response;

class EditController extends Controller
{
    public function __invoke(News $news)
    {
        return response($news, Response::HTTP_OK);
    }
}
