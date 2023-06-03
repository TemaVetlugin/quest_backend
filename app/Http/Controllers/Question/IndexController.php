<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Http\Resources\Question\QuestionResource;
use App\Models\Question;

class IndexController extends Controller
{
    public function __invoke()
    {
        $news=Question::orderBy('id', 'DESC')->get();
        return QuestionResource::collection($news);
    }

}
