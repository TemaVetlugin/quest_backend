<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(Request $request, Question $question)
    {
        $data=$request->input();
        $question->update($data);
        return response('Вопрос изменен', Response::HTTP_OK);
    }
}
