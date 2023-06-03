<?php

namespace App\Http\Controllers\Question;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class DeleteController extends Controller
{
    public function __invoke( Question $question)
    {
        $question->delete();
        return response('Вопрос удален', Response::HTTP_OK);
    }
}
