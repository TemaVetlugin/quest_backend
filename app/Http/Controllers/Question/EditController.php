<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Response;

class EditController extends Controller
{
    public function __invoke(Question $question)
    {
        return response($question, Response::HTTP_OK);
    }
}
